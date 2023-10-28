<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user

        // Check if a user is authenticated
        if ($user) {
            $firstName = $user->profile->first_name;
            $lastName = $user->profile->last_name;
        } else {
            $firstName = '';
            $lastName = '';
        }
    
        return view('dashboard.index', compact('firstName', 'lastName'));
    }
}
