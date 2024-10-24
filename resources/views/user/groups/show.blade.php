@extends('layouts.user.app')

@section('content')

<div class="py-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.groups.index'), 'label' => 'Groups'],
        ['url' => route('user.groups.show', $group->id), 'label' => $group->name],
    ]"/>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">{{ $group->name }}</h1>
            <p class="mt-2 text-sm text-gray-600">Below are the contacts associated with this group. You can add or remove contacts as needed.</p>
        </div>
    </div>

    <!-- Add Contact Form -->
    <div class="mt-8">
        <form method="POST" action="{{ route('user.groups.addContact', $group->id) }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Select Contact -->
                <div>
                    <label for="contact_id" class="block text-sm font-medium text-gray-700">Select Contact to Add</label>
                    <select name="contact_id" id="contact_id" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                        @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex items-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-orange-500 text-white font-semibold rounded-md shadow hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-200">
                        Add Contact
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- List of Contacts in the Group -->
    <div class="mt-10">
        <h2 class="text-lg font-semibold text-gray-900">Contacts in This Group:</h2>
        @if($group->contacts->isEmpty())
            <p class="mt-4 text-sm text-gray-600">No contacts added to this group yet.</p>
        @else
            <ul class="mt-4 space-y-4">
                @foreach($group->contacts as $contact)
                    <li class="flex justify-between items-center bg-white shadow-md rounded-lg p-4">
                        <!-- Contact Name -->
                        <div class="text-sm font-medium text-gray-700">
                            <a href="{{ route('contacts.show', $contact->id) }}" class="text-orange-600 hover:text-orange-800 transition">
                                {{ $contact->name }}
                            </a>
                        </div>

                        <!-- Remove Button -->
                        <form action="{{ route('user.groups.removeContact', [$group->id, $contact->id]) }}" method="POST" class="flex-none">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 transition">
                                Remove
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

@endsection
