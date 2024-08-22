<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|max:1024',
        ]);

        // Update the profile photo if provided
        if ($request->hasFile('profile_photo')) {
            if ($user->profile->profile_photo) {
                Storage::delete($user->profile->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile->profile_photo = $path;
        }

        // Update other profile fields
        $user->profile->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
