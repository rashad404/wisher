@extends('layouts.user.app')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ $group->name }}</h1>
            <p class="mt-2 text-sm text-gray-700">Bu qrupdakı əlaqələr</p>
        </div>
    </div>

    <div class="mt-8">
        <form method="POST" action="{{ route('user.groups.addContact', $group->id) }}">
            @csrf
            <label for="contact_id" class="block text-sm font-medium text-gray-700">Əlaqə Əlavə Et</label>
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <select name="contact_id" id="contact_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Əlavə Et
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-8">
        <h2 class="text-lg font-medium text-gray-900">Bu Qrupdakı Əlaqələr:</h2>
        <ul class="mt-4 space-y-4">
            @foreach($group->contacts as $contact)
                <li class="flex justify-between items-center bg-white shadow-sm rounded-md p-4">
                    <div class="text-sm font-medium text-gray-700 flex-1">
                        <a href="{{ route('contacts.show', $contact->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            {{ $contact->name }}
                        </a>
                    </div>
                    <form action="{{ route('user.groups.removeContact', [$group->id, $contact->id]) }}" method="POST" class="flex-none">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900">
                            Çıxar
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
