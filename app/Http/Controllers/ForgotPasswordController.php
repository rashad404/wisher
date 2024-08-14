<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as PasswordFacade;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgotPassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return redirect()->route('password.sent');
        }

        return back()->withErrors(
            ['email' => __($response)]
        );
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.resetPassword')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'token' => ['required'],
        ]);

        $response = PasswordFacade::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
                Auth::login($user);
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('user.index')->with('status', __('Your password has been reset and you are now logged in.'));
        }

        return back()->withErrors(
            ['email' => [__($response)]]
        );
    }

    public function sendTestEmail()
    {
        \Illuminate\Support\Facades\Mail::raw('This is a test email.', function ($message) {
            $message->to('nihadnemetli9900@gmail.com')
                    ->subject('Test Email');
        });

        return 'Test email sent!';
    }
}
