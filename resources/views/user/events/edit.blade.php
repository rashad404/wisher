@extends('layouts.user.app')

@section('content')

<!-- Breadcrumbs -->
<div class="py-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.events.index'), 'label' => 'Events'],
        ['url' => route('user.events.edit', $event->id), 'label' => 'Edit']
    ]"/>
</div>

<!-- Form Container -->
<div class="container max-w-3xl mx-auto pt-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Event</h1>

    <!-- Edit Event Form -->
    <form method="POST" action="{{ route('user.events.update', $event->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Event Name Field -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-900">Name*</label>
            <div class="mt-2">
                <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 px-4 py-3 text-gray-900 shadow-sm focus:ring-2 focus:ring-inset focus:ring-[#E9654B]" required value="{{ old('name', $event->name) }}">
                @if ($errors->has('name'))
                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>

        <!-- Date Field -->
        <div>
            <label for="date" class="block text-sm font-semibold text-gray-900">Date*</label>
            <div class="mt-2">
                <input type="date" name="date" id="date" class="block w-full rounded-md border-0 px-4 py-3 text-gray-900 shadow-sm focus:ring-2 focus:ring-inset focus:ring-[#E9654B]" required value="{{ old('date', $event->date) }}">
                @if ($errors->has('date'))
                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('date') }}</p>
                @endif
            </div>
        </div>

        <!-- Recurrence Field (Updated to match your request) -->
        <div>
            <label for="recurrence" class="block text-sm font-semibold leading-6 text-gray-900">Recurrence</label>
            <div class="mt-2">
                <select name="recurrence" id="recurrence" class="block w-full rounded-md border-0 px-4 py-3 text-gray-900 shadow-sm focus:ring-2 focus:ring-inset focus:ring-[#E9654B]">
                    <option value="0" {{ old('recurrence', $event->recurrence) == 0 ? 'selected' : '' }}>None</option>
                    <option value="1" {{ old('recurrence', $event->recurrence) == 1 ? 'selected' : '' }}>Annually</option>
                    <option value="2" {{ old('recurrence', $event->recurrence) == 2 ? 'selected' : '' }}>Monthly</option>
                </select>
                @if ($errors->has('recurrence'))
                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('recurrence') }}</p>
                @endif
            </div>
        </div>

        <!-- Status Field (Updated to match your request) -->
        <div>
            <label class="block text-sm font-semibold leading-6 text-gray-900">Status*</label>
            <div class="mt-2 space-y-2">
                <div>
                    <input type="radio" name="status" id="active" value="1" class="mr-2" {{ old('status', $event->status) == '1' ? 'checked' : '' }}>
                    <label for="active" class="text-gray-900">Active</label>
                </div>
                <div>
                    <input type="radio" name="status" id="inactive" value="0" class="mr-2" {{ old('status', $event->status) == '0' ? 'checked' : '' }}>
                    <label for="inactive" class="text-gray-900">Inactive</label>
                </div>
                @if ($errors->has('status'))
                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('status') }}</p>
                @endif
            </div>
        </div>

        <!-- Group Field -->
        <div>
            <label for="group_id" class="block text-sm font-semibold leading-6 text-gray-900">Group</label>
            <div class="mt-2">
                <select name="group_id" id="group_id" class="block w-full rounded-md border-0 px-4 py-3 text-gray-900 shadow-sm focus:ring-2 focus:ring-inset focus:ring-[#E9654B]">
                    <option value="">Select Group (Optional)</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}" {{ old('group_id', $event->group_id) == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Contact Field -->
        <div>
            <label for="contact_id" class="block text-sm font-semibold leading-6 text-gray-900">Contact</label>
            <div class="mt-2">
                <select name="contact_id" id="contact_id" class="block w-full rounded-md border-0 px-4 py-3 text-gray-900 shadow-sm focus:ring-2 focus:ring-inset focus:ring-[#E9654B]">
                    <option value="">Select Contact (Optional)</option>
                    @foreach($contacts as $contact)
                        <option value="{{ $contact->id }}" {{ old('contact_id', $event->contact_id) == $contact->id ? 'selected' : '' }}>{{ $contact->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="inline-block w-full rounded-md bg-[#E9654B] px-4 py-3 text-sm font-semibold text-white shadow hover:bg-[#e65b39] focus:outline-none focus:ring-2 focus:ring-[#E9654B] focus:ring-offset-2">Save Changes</button>
        </div>
    </form>
</div>

@endsection
