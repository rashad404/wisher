<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
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
    
        return view('user.contacts.index', compact('firstName', 'lastName'));
    }

    public function view()
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
    
        return view('user.contacts.view', compact('firstName', 'lastName'));
    }
}
