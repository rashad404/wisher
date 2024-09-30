<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function getUserProfiles(Request $request)
    {
        $userProfiles = UserProfile::all();

        return response()->json($userProfiles);
    }
}

