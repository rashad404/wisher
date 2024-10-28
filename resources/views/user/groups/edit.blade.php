@extends('layouts.user.app')

@section('content')

<div class="py-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.groups.index'), 'label' => 'Groups'],
        ['url' => isset($group) ? route('user.groups.edit', $group->id) : route('user.groups.create'), 'label' => isset($group) ? 'Edit' : 'Create']
    ]"/>
</div>

<div class="max-w-3xl mx-auto py-12">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">{{ isset($group) ? 'Edit' : 'Create' }} Group</h1>

    <form method="POST" action="{{ isset($group) ? route('user.groups.update', $group->id) : route('user.groups.store') }}" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @if(isset($group))
            @method('PUT')
        @endif

        <!-- Group Name Field -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700">Group Name*</label>
            <input type="text" name="name" id="name" class="mt-2 block w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 shadow-sm focus:ring-orange-500 focus:border-orange-500" required value="{{ old('name', $group->name ?? '') }}">
            @if ($errors->has('name'))
                <p class="mt-2 text-sm text-red-600">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-orange-500 text-white text-sm font-semibold rounded-md shadow hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-200">
                {{ isset($group) ? 'Update' : 'Create' }} Group
            </button>
        </div>
    </form>
</div>

@endsection
