@extends('layouts.user.app')

@section('content')

<div class="py-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.profile'), 'label' => 'Profile']
    ]"/>
</div>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Your Profile</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center space-x-4 mb-4">
            <img class="h-16 w-16 rounded-full" src="{{ $user->profile->profile_photo ? Storage::url($user->profile->profile_photo) : asset('images/user.png') }}" alt="{{ $user->profile->first_name }} {{ $user->profile->last_name }}">

            <div>
                <h2 class="text-xl font-semibold">{{ $user->profile->first_name }} {{ $user->profile->last_name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
        </div>

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ $user->profile->first_name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ $user->profile->last_name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="dob" id="dob" value="{{ $user->profile->dob }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="1" {{ $user->profile->gender == 1 ? 'selected' : '' }}>Male</option>
                    <option value="0" {{ $user->profile->gender == 0 ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" value="{{ $user->profile->address }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" name="city" id="city" value="{{ $user->profile->city }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                <input type="text" name="state" id="state" value="{{ $user->profile->state }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="zip" class="block text-sm font-medium text-gray-700">Zip</label>
                <input type="text" name="zip" id="zip" value="{{ $user->profile->zip }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                <input type="text" name="country" id="country" value="{{ $user->profile->country }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ $user->profile->phone_number }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="profile_photo" class="block text-sm font-medium text-gray-700">Profile Photo</label>
                <input type="file" name="profile_photo" id="profile_photo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">Update Profile</button>
        </form>
    </div>
</div>
@endsection
