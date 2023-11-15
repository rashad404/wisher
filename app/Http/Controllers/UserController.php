<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
         // Get the authenticated user
        $user = Auth::user();

        // Check if a user is authenticated
        if ($user) {
            $firstName = $user->profile->first_name;
            $lastName = $user->profile->last_name;
        } else {
            $firstName = '';
            $lastName = '';
        }
    
        return view('user.index', compact('firstName', 'lastName'));
    }
}
