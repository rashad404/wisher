@extends('layouts.user.app')

@section('content')

@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Whoops! Something went wrong.</strong>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif


    <!-- Breadcrumbs -->
    <div class="py-4">
        <x-breadcrumbs :links="[
            ['url' => route('user.index'), 'label' => 'Home'],
            ['url' => route('user.contacts.index'), 'label' => 'Contacts'],
            ['url' => route('user.contacts.show', $contact->id), 'label' => $contact->name],
        ]"/>
    </div>

    <div class="flex justify-center items-start py-8">
        <div class="w-full max-w-4xl">
            <!-- Contact Details -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <img class="h-24 w-24 rounded-full border-4 border-gray-300" src="{{ Storage::url($contact->photo) }}" alt="{{ $contact->name }}">
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $contact->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $contact->title ?? 'No Title' }}</p>
                    </div>
                </div>
                <!-- Edit Button -->
                <a href="{{ route('user.contacts.edit', $contact->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-semibold rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                    Edit
                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M16.732 3.732a2.5 2.5 0 113.536 3.536l-10.607 10.607a4 4 0 01-1.414.828l-4.242 1.414a1 1 0 01-1.272-1.272l1.414-4.242a4 4 0 01.828-1.414l10.607-10.607z" />
                    </svg>
                </a>
            </div>

            <!-- Related Events Section -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Related Events</h3>
                @if($contact->events->isNotEmpty())
                    <ul class="space-y-2">
                        @foreach($contact->events as $event)
                            <li class="flex justify-between text-sm text-gray-700">
                                <span class="font-semibold text-gray-900">{{ $event->name }}</span>
                                <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">No events found for this contact.</p>
                @endif
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                <div>
                    <span class="block text-sm font-semibold text-gray-900">Phone</span>
                    <span class="block text-gray-700">{{ $contact->phone_number ?: 'No Phone Number' }}</span>
                </div>
                <div>
                    <span class="block text-sm font-semibold text-gray-900">Email</span>
                    <a href="mailto:{{ $contact->email ?? '#' }}" class="block text-indigo-600 underline">
                        {{ $contact->email ?: 'No Email' }}
                    </a>
                </div>
                <div>
                    <span class="block text-sm font-semibold text-gray-900">Birthdate</span>
                    <span class="block text-gray-700">
                        {{ $contact->birthdate ? \Carbon\Carbon::parse($contact->birthdate)->format('d M Y') : 'No Birthdate' }}
                    </span>
                </div>
                <div>
                    <span class="block text-sm font-semibold text-gray-900">Address</span>
                    <span class="block text-gray-700">{{ $contact->address ?: 'No Address' }}</span>
                </div>
            </div>

            <!-- Interests Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Interests</h3>
                    <a href="{{ route('contacts.interests.index', $contact->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Manage Interests</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Likes -->
                    <div>
                        <h4 class="text-lg font-semibold text-green-600 mb-2">Likes</h4>
                        @php
                            $likes = $contact->interests()->where('contact_interests.type', 'like')->get();
                        @endphp
                        @if($likes->isEmpty())
                            <p class="text-gray-500 text-sm">No likes added.</p>
                        @else
                            <ul class="space-y-2">
                                @foreach($likes as $like)
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-700">{{ $like->trans('name') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Dislikes -->
                    <div>
                        <h4 class="text-lg font-semibold text-red-600 mb-2">Dislikes</h4>
                        @php
                            $dislikes = $contact->interests()->where('contact_interests.type', 'dislike')->get();
                        @endphp
                        @if($dislikes->isEmpty())
                            <p class="text-gray-500 text-sm">No dislikes added.</p>
                        @else
                            <ul class="space-y-2">
                                @foreach($dislikes as $dislike)
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-red-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-700">{{ $dislike->trans('name') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Groups Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Groups</h3>
                    <a href="{{ route('user.groups.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        Manage Groups
                    </a>
                </div>
                @if($contact->groups->isNotEmpty())
                    <ul class="space-y-2">
                        @foreach($contact->groups as $group)
                            <li class="flex justify-between items-center text-sm text-gray-700">
                                <a href="{{ route('user.groups.show', $group->id) }}" class="font-semibold text-indigo-600 hover:text-indigo-900">
                                    {{ $group->name }}
                                </a>
                                <form action="{{ route('user.groups.removeContact', [$group->id, $contact->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this contact from the group?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        Remove
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">This contact is not in any groups.</p>
                @endif
            </div>

            <!-- SMS and Email Forms -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Send Message</h3>
                
                <!-- SMS Form -->
                <form action="{{ route('contacts.sendSms', $contact->id) }}" method="POST" class="mb-4">
                    @csrf
                    <div>
                        <label for="sms-message" class="block text-sm font-semibold text-gray-900">SMS Message</label>
                        <textarea id="sms-message" name="message" class="w-full border border-gray-300 rounded-md p-2" required></textarea>
                    </div>
                    <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md">Send SMS</button>
                </form>

                <!-- Email Form -->
                <form action="{{ route('contacts.sendEmail', $contact->id) }}" method="POST">
                    @csrf
                    <div>
                        <label for="email-message" class="block text-sm font-semibold text-gray-900">Email Message</label>
                        <textarea id="email-message" name="message" class="w-full border border-gray-300 rounded-md p-2" required></textarea>
                    </div>
                    <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md">Send Email</button>
                </form>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-6 justify-center">
                @if($contact->registered_user_id)
                    <a href="{{ route('chat.withUser', $contact->registered_user_id) }}" class="flex items-center justify-center w-48 rounded-md bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4m-2-2v4m0 0v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6m6 6V6a2 2 0 012-2h6a2 2 0 012 2v6" />
                        </svg>
                        Send Message
                    </a>
                @else
                    <button type="button" disabled class="flex items-center justify-center w-48 rounded-md bg-gray-400 px-6 py-3 text-sm font-semibold text-white shadow-md">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4m-2-2v4m0 0v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6m6 6V6a2 2 0 012-2h6a2 2 0 012 2v6" />
                        </svg>
                        Not Registered
                    </button>
                @endif
                <button type="button" class="flex items-center justify-center w-48 rounded-md bg-yellow-600 px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8V6m0 12v-2m8-10H4m16 10H4m5-8a4 4 0 00-8 0h2a2 2 0 114 0h6a2 2 0 114 0h2a4 4 0 00-8 0h-2zM5 16v2m10-2v2" />
                    </svg>
                    Send Gift
                </button>
            </div>
        </div>
    </div>
@endsection
