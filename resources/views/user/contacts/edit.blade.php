@extends('layouts.user.app')

@section('content')

@if ($errors->any())
    <div class="mb-4 p-4 border border-red-500 bg-red-50 rounded-lg">
        <div class="font-bold text-red-600">Whoops! Something went wrong:</div>
        <ul class="mt-2 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Breadcrumbs -->
<div class="py-4">
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Home')],
        ['url' => route('user.contacts.index'), 'label' => __('Contacts')],
        ['url' => route('user.contacts.edit', $contact), 'label' => __('Edit Contact')],
    ]"/>
</div>

<!-- Contact Edit Form -->
<form method="POST" action="{{ route('user.contacts.update', $contact->id) }}" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    <div class="bg-white shadow-lg rounded-lg p-6 sm:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-8">Update Contact Information</h2>

        <!-- Photo Upload Section -->
        <div class="sm:flex sm:items-center space-x-6 mb-8">
            @if($contact->photo)
                <img class="h-20 w-20 rounded-full object-cover border border-gray-300 shadow-md" src="{{ asset('storage/' . $contact->photo) }}" alt="{{ $contact->name }}">
            @else
                <div class="h-20 w-20 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="h-10 w-10 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            @endif
            <div class="text-sm text-gray-600 mt-4 sm:mt-0">
                <label for="photo-upload" class="cursor-pointer text-indigo-600 font-semibold hover:underline">
                    Change Photo
                    <input id="photo-upload" name="photo" type="file" class="sr-only">
                </label>
            </div>
        </div>

        <!-- Name Field -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full mt-2 p-3 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $contact->name }}">
        </div>

        <!-- Email Field -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" autocomplete="email" class="block w-full mt-2 p-3 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $contact->email }}">
        </div>

        <!-- Phone Number Field -->
        <div class="mb-6">
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" autocomplete="tel" class="block w-full mt-2 p-3 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $contact->phone_number }}">
        </div>

        <!-- Birthdate Field -->
        <div class="mb-6">
            <label for="birthdate" class="block text-sm font-medium text-gray-700">Birthdate</label>
            <input type="date" name="birthdate" id="birthdate" autocomplete="bday" class="block w-full mt-2 p-3 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $contact->birthdate }}">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-8">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                Update Contact
            </button>
        </div>
    </div>
</form>

@endsection
