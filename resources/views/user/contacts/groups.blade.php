@extends('layouts.user.app')

@section('content')
<div class="py-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.contacts.index'), 'label' => 'Contacts'],
        ['url' => route('user.contacts.show', $contact->id), 'label' => $contact->name],
        ['url' => route('contacts.groups.index', $contact->id), 'label' => 'Groups']
    ]"/>
</div>

<div class="py-12">
    <!-- Form to add a new group related to the contact -->
    <form action="{{ route('contacts.groups.store', $contact) }}" method="POST" class="mb-8">
        @csrf

        <!-- Dropdown to select the group -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="group_id" class="block text-sm font-medium text-gray-700">Group*</label>
                <select name="group_id" id="group_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select a Group</option>
                    @foreach($allGroups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Hidden input for contact id -->
            <input type="hidden" name="contact_id" value="{{ $contact->id }}">
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                Add Group
            </button>
        </div>
    </form>

    <!-- Display current groups related to the contact -->
    <div class="mt-12">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Groups</h2>
        <ul class="space-y-4">
            @forelse($groups as $group)
                <li class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                    <div>
                        <span class="block text-gray-700">{{ $group->name }}</span>
                    </div>
                    <form action="{{ route('contacts.groups.destroy', [$contact, $group->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 transition">
                            Remove
                        </button>
                    </form>
                </li>
            @empty
                <li class="text-gray-500">No groups added yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
