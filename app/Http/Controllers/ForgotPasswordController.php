<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgotPassword');
    }


    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        // Set an error message in the session
        return redirect()->route('login')->with('error', 'The provided credentials do not match our records.');

    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'dob' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Create a new user
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Create a profile for the user
        $user->profile()->create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
        ]);

        // Log in the user
        Auth::login($user);
        
        // Redirect to a success page or login page
        return redirect('/dashboard')->with('success', 'Registration successful. You can now log in.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout the user
        $request->session()->invalidate(); // Invalidate the user's session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect('/login'); // Redirect to the login page or any other desired page
    }
}