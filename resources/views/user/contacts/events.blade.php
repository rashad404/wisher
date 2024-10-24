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
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New Event</h2>

        <form action="{{ route('contacts.events.store', $contact) }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Input for event name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Event Name*</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E9654B] focus:border-[#E9654B]" required>
                </div>

                <!-- Input for event date -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Event Date*</label>
                    <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E9654B] focus:border-[#E9654B]" required>
                </div>

                <!-- Dropdown to select recurrence -->
                <div>
                    <label for="recurrence" class="block text-sm font-medium text-gray-700">Recurrence</label>
                    <select name="recurrence" id="recurrence" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E9654B] focus:border-[#E9654B]">
                        <option value="0">None</option>
                        <option value="1">Monthly</option>
                        <option value="2">Yearly</option>
                    </select>
                </div>

                <!-- Dropdown to select the status of the event -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Event Status*</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E9654B] focus:border-[#E9654B]" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Dropdown to select the group -->
                <div>
                    <label for="group_id" class="block text-sm font-medium text-gray-700">Group</label>
                    <select name="group_id" id="group_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E9654B] focus:border-[#E9654B]">
                        <option value="">Select a Group</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Hidden input for contact id -->
                <input type="hidden" name="contact_id" value="{{ $contact->id }}">
            </div>

            <div class="mt-6 flex justify-end">
                <!-- Redesigned Button with Orange Theme -->
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#E9654B] text-white font-semibold rounded-md shadow-sm hover:bg-[#e65b39] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E9654B] transition duration-300">
                    Add Event
                </button>
            </div>
        </form>
    </div>

    <!-- Display current events related to the contact -->
    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Existing Events</h2>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <ul class="divide-y divide-gray-200">
                @forelse($events as $event)
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <p class="text-lg font-medium text-gray-700">
                                {{ $event->name }} ({{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }})
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ ['None', 'Monthly', 'Yearly'][$event->recurrence] ?? 'None' }} | Status: {{ ucfirst($event->status) }}
                            </p>
                        </div>
                        <form action="{{ route('contacts.events.destroy', [$contact, $event]) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 transition">Remove</button>
                        </form>
                    </li>
                @empty
                    <li class="py-4 text-gray-500 text-center">No events added yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
