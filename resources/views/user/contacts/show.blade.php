@extends('layouts.user.app')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-lg flex-none flex-col divide-y divide-gray-100">
        <div class="flex-none p-6 text-center">
            <img src="{{ $contact->profile_image_url ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}" alt="" class="mx-auto h-24 w-24 rounded-full">
            <h2 class="mt-3 text-lg font-semibold text-gray-900">{{ $contact->name }}</h2>
            <p class="text-sm leading-6 text-gray-500">{{ $contact->title ?? 'No Title' }}</p>
        </div>
        <div class="flex flex-auto flex-col justify-between p-6">
            <div class="space-y-4">
                <div class="flex justify-between text-sm text-gray-700">
                    <span class="font-semibold text-gray-900">Phone</span>
                    <span>{{ $contact->phone_number ?: 'No Phone Number' }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-700">
                    <span class="font-semibold text-gray-900">Email</span>
                    <span class="truncate">
                        <a href="mailto:{{ $contact->email ?? '#' }}" class="text-indigo-600 underline">
                            {{ $contact->email ?: 'No Email' }}
                        </a>
                    </span>
                </div>
                <div class="flex justify-between text-sm text-gray-700">
                    <span class="font-semibold text-gray-900">Birthdate</span>
                    <span>
                        {{ $contact->birthdate ? \Carbon\Carbon::parse($contact->birthdate)->format('d M Y') : 'No Birthdate' }}
                    </span>
                </div>
                <div class="flex justify-between text-sm text-gray-700">
                    <span class="font-semibold text-gray-900">Address</span>
                    <span>{{ $contact->address ?: 'No Address' }}</span>
                </div>
            </div>
            <div class="mt-6 flex gap-6 justify-center">
                <button type="button" onclick="window.history.back()" class="w-32 rounded-md bg-gray-300 px-4 py-2 text-sm font-semibold text-gray-900 shadow-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">Back</button>
                <button type="button" class="w-32 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">Send message</button>
            </div>
        </div>
    </div>
</div>
@endsection
