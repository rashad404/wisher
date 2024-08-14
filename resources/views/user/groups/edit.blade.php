@extends('layouts.user.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold text-gray-900">{{ isset($group) ? 'Edit' : 'Create' }} Group</h1>
    
    <form method="POST" action="{{ isset($group) ? route('user.groups.update', $group->id) : route('user.groups.store') }}">
        @csrf
        @if(isset($group))
            @method('PUT')
        @endif

        <label for="name">Group Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $group->name ?? '') }}" required>
        
        <button type="submit" class="btn btn-primary">{{ isset($group) ? 'Update' : 'Create' }} Group</button>
    </form>
</div>
@endsection
