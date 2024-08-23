@extends('layouts.user.app')

@section('content')


<div class="py-6">
        <x-breadcrumbs :links="[
            ['url' => route('user.index'), 'label' => 'Home'],
            ['url' => route('user.contacts.index'), 'label' => 'Contacts'],
            ['url' => route('user.contacts.show', $contact->id), 'label' => $contact->name],
            ['url' => route('contacts.interests.index', $contact->id), 'label' => 'Interests']
        ]"/>
    </div>

    <div class="py-12">


        <!-- Form to add new interest (like/dislike) to the contact -->
        <form action="{{ route('contacts.interests.store', $contact) }}" method="POST" class="mb-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Dropdown to select an interest -->
                <div>
                    <label for="interest_id" class="block text-sm font-medium text-gray-700">Select Interest</label>
                    <select name="interest_id" id="interest_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        @foreach(App\Models\Interest::all() as $interest)
                            <option value="{{ $interest->id }}">{{ $interest->trans('name') }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown to select the type (like/dislike) -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="like">Like</option>
                        <option value="dislike">Dislike</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                    Add Interest
                </button>
            </div>
        </form>

        <!-- Display current likes for the contact -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Likes</h2>
            <ul class="space-y-4">
                @forelse($likes as $like)
                    <li class="flex justify-between items-center bg-green-50 p-4 rounded-lg shadow-sm">
                        <span>{{ $like->trans('name') }}</span>
                        <form action="{{ route('contacts.interests.destroy', [$contact, $like, 'like']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 transition">Remove</button>
                        </form>
                    </li>
                @empty
                    <li class="text-gray-500">No likes added yet.</li>
                @endforelse
            </ul>
        </div>

        <!-- Display current dislikes for the contact -->
        <div>
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Dislikes</h2>
            <ul class="space-y-4">
                @forelse($dislikes as $dislike)
                    <li class="flex justify-between items-center bg-red-50 p-4 rounded-lg shadow-sm">
                        <span>{{ $dislike->trans('name') }}</span>
                        <form action="{{ route('contacts.interests.destroy', [$contact, $dislike, 'dislike']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 transition">Remove</button>
                        </form>
                    </li>
                @empty
                    <li class="text-gray-500">No dislikes added yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
