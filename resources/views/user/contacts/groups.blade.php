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

<div class="py-12 max-w-4xl mx-auto">
    <!-- Form to add a new group related to the contact -->
    <form action="{{ route('contacts.groups.store', $contact) }}" method="POST" class="mb-8 bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Dropdown to select the group -->
            <div>
                <label for="group_id" class="block text-sm font-medium text-gray-700">Select Group*</label>
                <select name="group_id" id="group_id" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500" required>
                    <option value="">Choose a Group</option>
                    @foreach($allGroups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Hidden input for contact id -->
            <input type="hidden" name="contact_id" value="{{ $contact->id }}">
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-500 text-white font-semibold rounded-lg shadow-sm hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition ease-in-out duration-200">
                Add Group
            </button>
        </div>
    </form>

    <!-- Display current groups related to the contact -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Groups</h2>
        <ul class="divide-y divide-gray-200">
            @forelse($groups as $group)
                <li class="flex justify-between items-center py-4">
                    <span class="text-lg text-gray-700">{{ $group->name }}</span>
                    <form action="{{ route('contacts.groups.destroy', [$contact, $group->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block px-4 py-2 bg-orange-500 text-white font-semibold rounded-lg shadow-sm hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition ease-in-out duration-200">
                            Remove
                        </button>
                    </form>
                </li>
            @empty
                <li class="py-4 text-center text-gray-500">No groups added yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
