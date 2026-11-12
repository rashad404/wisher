<?php

namespace App\Http\Controllers;


use App\Services\KimlikIdentity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class KimlikController
{
    public function start(Request $r)
    {
        abort_unless(config('kimlik.client_id') && config('kimlik.client_secret'), 503);
        $d = $r->validate(['state' => 'required|string|min:32|max:128', 'code_challenge' => 'required|string|size:43', 'redirect_uri' => 'required|url|max:500']);
        $valid = false;
        foreach (config('kimlik.origins') as $origin) {
            if (preg_match('~^'.preg_quote($origin, '~').'/(az)/auth/kimlik/callback$~D', $d['redirect_uri'])) {
                $valid = true;
            }
        }
        abort_unless($valid, 422);
        $transaction = Str::random(64);
        Cache::put('kimlik:'.hash('sha256', $transaction), $d, now()->addMinutes(10));

        return ['transaction' => $transaction];
    }

    public function callback(Request $r)
    {
        $d = $r->validate(['transaction' => 'required|string|size:64', 'state' => 'required|string|max:128', 'code' => 'required|string|max:2000', 'code_verifier' => ['required', 'regex:/^[A-Za-z0-9._~-]{43,128}$/'], 'redirect_uri' => 'required|url|max:500']);
        $saved = Cache::lock('kimlik-lock:'.hash('sha256', $d['transaction']), 5)->block(2, fn () => Cache::pull('kimlik:'.hash('sha256', $d['transaction'])));
        $challenge = rtrim(strtr(base64_encode(hash('sha256', $d['code_verifier'], true)), '+/', '-_'), '=');
        abort_unless($saved && hash_equals($saved['state'], $d['state']) && hash_equals($saved['code_challenge'], $challenge) && $saved['redirect_uri'] === $d['redirect_uri'], 422);
        abort_unless(config('kimlik.client_id') && config('kimlik.client_secret'), 503);
        try {
            $tokens = Http::timeout(15)->post(rtrim(config('kimlik.api_url'), '/').'/oauth/token', ['grant_type' => 'authorization_code', 'client_id' => config('kimlik.client_id'), 'client_secret' => config('kimlik.client_secret'), 'code' => $d['code'], 'code_verifier' => $d['code_verifier'], 'redirect_uri' => $d['redirect_uri']]);
            if (! $tokens->successful() || ! is_string($tokens->json('access_token'))) {
                return response()->json(['error' => 'login_failed'], 401);
            }
            $identity = Http::timeout(15)->withToken($tokens->json('access_token'))->get(rtrim(config('kimlik.api_url'), '/').'/oauth/user');
            if (! $identity->successful()) {
                return response()->json(['error' => 'login_failed'], 401);
            }
            $profile = $identity->json('data');
        } catch (\Throwable) {
            return response()->json(['error' => 'login_failed'], 503);
        }
        $user = app(KimlikIdentity::class)->resolve($profile);
        preg_match('~/(az)/auth/kimlik/callback$~', $saved['redirect_uri'], $locale);
        app()->setLocale($locale[1] ?? 'az');


        return ['user' => $user->only(['id', 'name', 'language', 'timezone', 'is_demo']), 'token' => $user->createToken('wisher', ['*'], now()->addDays(30))->plainTextToken];
    }

    public function me(Request $r)
    {
        return ['user' => $r->user()->only(['id', 'name', 'language', 'timezone', 'is_demo'])];
    }

    public function logout(Request $r)
    {
        $r->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
