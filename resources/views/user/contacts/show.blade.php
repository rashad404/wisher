@extends('layouts.user.app')

@section('content')
    <!-- Breadcrumbs -->
    <div class="py-6">
        <x-breadcrumbs :links="[
            ['url' => route('user.index'), 'label' => 'Home'],
            ['url' => route('user.contacts.index'), 'label' => 'Contacts'],
            ['url' => route('user.contacts.show', $contact->id), 'label' => $contact->name],
        ]"/>
    </div>
<div class="flex items-center h-[80vh] py-12">
    <div class="w-full max-w-lg flex-none flex-col divide-y divide-gray-100">
        
        <div class="flex-none p-6 text-center">
            <img class="mx-auto h-24 w-24 rounded-full" src="{{ Storage::url($contact->photo) }}" alt="{{ $contact->name }}">
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

                <!-- Redesigned Interests Section -->
                <div class="mt-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Interests</h3>
                        <a href="{{ route('contacts.interests.index', $contact->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Manage Interests</a>
                    </div>
                    <div class="mt-3">
                        <!-- Likes Section -->
                        <div class="mb-4">
                            <h4 class="text-sm font-semibold text-green-600">Likes</h4>
                            @php
                                $likes = $contact->interests()->where('contact_interests.type', 'like')->get();
                            @endphp
                            @if($likes->isEmpty())
                                <p class="text-gray-500 text-sm">No likes added.</p>
                            @else
                                <ul class="mt-2 space-y-1">
                                    @foreach($likes as $like)
                                        <li class="flex items-center text-gray-700 text-sm">
                                            <svg class="h-4 w-4 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ $like->trans('name') }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <!-- Dislikes Section -->
                        <div>
                            <h4 class="text-sm font-semibold text-red-600">Dislikes</h4>
                            @php
                                $dislikes = $contact->interests()->where('contact_interests.type', 'dislike')->get();
                            @endphp
                            @if($dislikes->isEmpty())
                                <p class="text-gray-500 text-sm">No dislikes added.</p>
                            @else
                                <ul class="mt-2 space-y-1">
                                    @foreach($dislikes as $dislike)
                                        <li class="flex items-center text-gray-700 text-sm">
                                            <svg class="h-4 w-4 text-red-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ $dislike->trans('name') }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display related events -->
            @if($contact->events->isNotEmpty())
                <div class="mt-6 space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">Related Events</h3>
                    <ul class="space-y-2">
                        @foreach($contact->events as $event)
                            <li class="flex justify-between text-sm text-gray-700">
                                <span class="font-semibold text-gray-900">{{ $event->name }}</span>
                                <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="mt-6">
                    <p class="text-sm text-gray-500">No events found for this contact.</p>
                </div>
            @endif

            <div class="mt-6 flex gap-6 justify-center">

                <button type="button" onclick="window.history.back()" class="w-32 rounded-md bg-gray-300 px-4 py-2 text-sm font-semibold text-gray-900 shadow-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">Back</button>
                <button type="button" class="w-32 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">Send message</button>
            </div>
        </div>
    </div>
</div>
@endsection
