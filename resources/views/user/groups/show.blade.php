@extends('layouts.user.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold text-gray-900">{{ $group->name }}</h1>

    <form method="POST" action="{{ route('user.groups.addContact', $group->id) }}">
        @csrf
        <label for="contact_id">Add Contact</label>
        <select name="contact_id" id="contact_id">
            @foreach($contacts as $contact)
                <option value="{{ $contact->id }}">{{ $contact->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Add to Group</button>
    </form>

    <h2 class="mt-6 text-lg">Contacts in this Group:</h2>
    <ul>
        @foreach($group->contacts as $contact)
            <li>{{ $contact->name }}
                <form action="{{ route('user.groups.removeContact', [$group->id, $contact->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
