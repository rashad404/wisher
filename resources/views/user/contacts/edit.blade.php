@extends('layouts.user.app')

@section('content')
<div class="py-6">

    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Home')],
        ['url' => route('user.contacts.index'), 'label' => __('Contacts')],
        ['url' => route('user.contacts.edit', $contact), 'label' => __('Edit Contact')]
    ]"/>
</div>

<form method="POST" action="{{ route('user.contacts.update', $contact->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="space-y-12 sm:space-y-16">
      <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Dəyiş</h2>
        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-600">Lorem İpsum...</p>

        <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">

            <!-- Photo Field -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="photo" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Photo:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-2xl justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            @if($contact->photo)
                                <img src="{{ asset('storage/' . $contact->photo) }}" alt="Contact Photo" class="mx-auto h-12 w-12 text-gray-300">
                            @else
                                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                </svg>
                            @endif
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="photo-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="photo-upload" name="photo" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other fields here -->
            <!-- Name Field -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Name:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->name }}">
                </div>
            </div>

            <!-- Email Field -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Email:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->email }}">
                </div>
            </div>

            <!-- Phone Number Field -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Phone Number:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="text" name="phone_number" id="phone_number" autocomplete="tel" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->phone_number }}">
                </div>
            </div>

            <!-- Birthdate Field -->
            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="birthdate" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Birthdate:</label>
                <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <input type="date" name="birthdate" id="birthdate" autocomplete="bday" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->birthdate }}">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-4">Update Contact</button>
        </div>
    </form>

@endsection
