@extends('layouts.user.app')

@section('content')

<!-- Error Display -->
@if ($errors->any())
    <div class="mb-4">
        <div class="font-medium text-red-600">Whoops! Something went wrong.</div>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
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

<div class="space-y-12 sm:space-y-16">
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Your Profile</h2>

        <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">

            <!-- Profile Photo -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="profile_photo" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Profile Photo:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-2xl justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <img src="{{ $user->profile->profile_photo ? Storage::url($user->profile->profile_photo) : asset('images/user.png') }}" alt="{{ $user->profile->first_name }} {{ $user->profile->last_name }}" class="mx-auto h-16 w-16 rounded-full">
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="photo-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="photo-upload" name="profile_photo" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- First Name -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">First Name:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="first_name" id="first_name" value="{{ $user->profile->first_name }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Last Name -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Last Name:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="last_name" id="last_name" value="{{ $user->profile->last_name }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Date of Birth -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="dob" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Date of Birth:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="date" name="dob" id="dob" value="{{ $user->profile->dob }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Gender -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="gender" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Gender:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <select name="gender" id="gender" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option value="1" {{ $user->profile->gender == 1 ? 'selected' : '' }}>Male</option>
                        <option value="0" {{ $user->profile->gender == 0 ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>

            <!-- Address -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="address" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Address:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="address" id="address" value="{{ $user->profile->address }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- City -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="city" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">City:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="city" id="city" value="{{ $user->profile->city }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- State -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="state" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">State:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="state" id="state" value="{{ $user->profile->state }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Zip -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="zip" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Zip:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="zip" id="zip" value="{{ $user->profile->zip }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Country -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="country" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Country:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="country" id="country" value="{{ $user->profile->country }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Phone Number -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Phone Number:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="phone_number" id="phone_number" value="{{ $user->profile->phone_number }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <div class="sm:col-span-3 sm:mt-4 sm:pt-1.5">
                    <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Profile</button>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection
