@extends('layouts.user.app')

@section('content')
<div class="py-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.contacts.index'), 'label' => 'Contacts'],
        ['url' => route('user.contacts.show', $contact->id), 'label' => $contact->name],
        ['url' => route('contacts.events.index', $contact->id), 'label' => 'Events']
    ]"/>
</div>

<div class="py-12">
    <!-- Form to add a new event related to the contact -->
    <form action="{{ route('contacts.events.store', $contact) }}" method="POST" class="mb-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Input for event name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name*</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Input for event date -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date*</label>
                <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Dropdown to select recurrence -->
            <div>
                <label for="recurrence" class="block text-sm font-medium text-gray-700">Recurrence</label>
                <select name="recurrence" id="recurrence" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="0">None</option>
                    <option value="1">Monthly</option>
                    <option value="2">Yearly</option>
                </select>
            </div>

            <!-- Dropdown to select the status of the event -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status*</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- Dropdown to select the group -->
            <div>
                <label for="group_id" class="block text-sm font-medium text-gray-700">Group</label>
                <select name="group_id" id="group_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select a Group</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Hidden input for contact id -->
            <input type="hidden" name="contact_id" value="{{ $contact->id }}">
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                Add Event
            </button>
        </div>
    </form>

    <!-- Display current events related to the contact -->
    <div class="mt-12">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Events</h2>
        <ul class="space-y-4">
            @forelse($events as $event)
                <li class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                    <div>
                        <span class="block text-gray-700">
                            {{ $event->name }} ({{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }})
                        </span>
                        <span class="block text-sm text-gray-500">
                            {{ ['None', 'Monthly', 'Yearly'][$event->recurrence] ?? 'None' }} |
                            Status: {{ ucfirst($event->status) }}
                        </span>
                    </div>
                    <form action="{{ route('contacts.events.destroy', [$contact, $event]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 transition">Remove</button>
                    </form>
                </li>
            @empty
                <li class="text-gray-500">No events added yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
