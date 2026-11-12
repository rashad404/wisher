<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KimlikIdentity
{
    public function resolve(mixed $profile): User
    {
        $profile = is_array($profile) ? $profile : [];
        if (isset($profile['id']) && is_int($profile['id'])) {
            $profile['id'] = (string) $profile['id'];
        }
        $profile = validator($profile, ['id' => 'required|string|max:255', 'name' => 'required|string|max:255', 'email' => 'nullable|email|max:255', 'phone' => 'nullable|string|max:40', 'avatar' => 'nullable|url|max:2000', 'verification' => 'sometimes|array'])->validate();

        return DB::transaction(function () use ($profile) {
            $user = User::where('kimlik_id', (string) $profile['id'])->lockForUpdate()->first();
            if (! $user && ! empty($profile['email'])) {
                $user = User::where('email', $profile['email'])->lockForUpdate()->first();
                if ($user) {
                    abort_unless(! $user->kimlik_id && ($profile['verification']['email_verified'] ?? false) === true, 409);
                }
            }
            if (! $user) {
                $user = new User(['password' => Str::random(64), 'email' => $profile['email'] ?? null]);
            }
            $user->fill(['kimlik_id' => (string) $profile['id'], 'name' => $profile['name']]);
            if (($profile['verification']['email_verified'] ?? false) === true && ($profile['email'] ?? null) === $user->email) {
                $user->email_verified_at = now();
            }
            $user->save();

            return $user;
        }, 3);
    }
}
