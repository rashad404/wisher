@extends('layouts.user.app')

@section('content')

<!-- Error Display -->
@if ($errors->any())
    <div class="mb-6">
        <div class="font-medium text-red-600">Whoops! Something went wrong.</div>
        <ul class="mt-2 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Breadcrumbs -->
<div class="py-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.profile'), 'label' => 'Profile']
    ]"/>
</div>

<div class="max-w-4xl mx-auto py-10">
    <h2 class="text-xl font-semibold text-gray-900 mb-6">Your Profile</h2>

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Profile Photo -->
        <div class="mb-8">
            <label for="profile_photo" class="block text-sm font-medium text-gray-700">Profile Photo:</label>
            <div class="mt-4 flex items-center space-x-4">
                <img src="{{ $user->profile->profile_photo ? Storage::url($user->profile->profile_photo) : asset('images/user.png') }}" alt="{{ $user->profile->first_name }} {{ $user->profile->last_name }}" class="h-16 w-16 rounded-full">
                <div>
                    <label for="photo-upload" class="block cursor-pointer rounded-md bg-orange-500 text-white px-4 py-2 text-sm font-medium hover:bg-orange-600">
                        Upload New Photo
                        <input id="photo-upload" name="profile_photo" type="file" class="sr-only">
                    </label>
                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
        </div>

        <!-- First Name -->
        <div class="mb-6">
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="{{ $user->profile->first_name }}" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>

        <!-- Last Name -->
        <div class="mb-6">
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="{{ $user->profile->last_name }}" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>

        <!-- Date of Birth -->
        <div class="mb-6">
            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth:</label>
            <input type="date" name="dob" id="dob" value="{{ $user->profile->dob }}" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>

        <!-- Gender -->
        <div class="mb-6">
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
            <select name="gender" id="gender" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
                <option value="1" {{ $user->profile->gender == 1 ? 'selected' : '' }}>Male</option>
                <option value="0" {{ $user->profile->gender == 0 ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <!-- Address -->
        <div class="mb-6">
            <label for="address" class="block text-sm font-medium text-gray-700">Address:</label>
            <input type="text" name="address" id="address" value="{{ $user->profile->address }}" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>

        <!-- City, State, Zip -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">City:</label>
                <input type="text" name="city" id="city" value="{{ $user->profile->city }}" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
            </div>
            <div>
                <label for="state" class="block text-sm font-medium text-gray-700">State:</label>
                <input type="text" name="state" id="state" value="{{ $user->profile->state }}" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
            </div>
            <div>
                <label for="zip" class="block text-sm font-medium text-gray-700">Zip:</label>
                <input type="text" name="zip" id="zip" value="{{ $user->profile->zip }}" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>

        <!-- Country -->
        <div class="mb-6">
            <label for="country" class="block text-sm font-medium text-gray-700">Country:</label>
            <input type="text" name="country" id="country" value="{{ $user->profile->country }}" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>

        <!-- Phone Number -->
        <div class="mb-6">
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ $user->profile->phone_number }}" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>

        <!-- Submit Button -->
        <div class="mt-8 text-right">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-orange-500 text-white text-sm font-semibold rounded-md shadow hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-200">
                Update Profile
            </button>
        </div>
    </form>
</div>

@endsection
