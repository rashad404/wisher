@extends('layouts.user.app')

@section('content')

<div class="py-6">
<x-breadcrumbs :links="[
    ['url' => route('user.index'), 'label' => 'Home'],
    ['url' => route('user.events.index'), 'label' => 'Event'],
    ['url' => route('user.events.create'), 'label' => 'Create']
]"/>
</div>

<div class="container pt-8">
    <h1 class="text-xl font-bold text-gray-900">Create an Important Date</h1>
    <form method="POST" action="{{ route('user.events.store') }}" class="max-w-xl sm:mt-10">
        @csrf
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <!-- Event Name Field -->
            <div>
                <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">Name*</label>
                <div class="mt-2.5">
                    <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>

            <!-- Date Field -->
            <div>
                <label for="date" class="block text-sm font-semibold leading-6 text-gray-900">Date*</label>
                <div class="mt-2.5">
                    <input type="date" name="date" id="date" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="{{ old('date') }}">
                    @if ($errors->has('date'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('date') }}</p>
                    @endif
                </div>
            </div>

            <!-- Recurrence Field -->
            <div>
                <label for="recurrence" class="block text-sm font-semibold leading-6 text-gray-900">Recurrence</label>
                <div class="mt-2.5">
                    <select name="recurrence" id="recurrence" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="0" {{ old('recurrence') === '0' ? 'selected' : '' }}>None</option>
                        <option value="1" {{ old('recurrence') === '1' ? 'selected' : '' }}>Annually</option>
                        <option value="2" {{ old('recurrence') === '2' ? 'selected' : '' }}>Monthly</option>
                    </select>
                    @if ($errors->has('recurrence'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('recurrence') }}</p>
                    @endif
                </div>
            </div>

            <!-- Status Field -->
            <div>
                <label class="block text-sm font-semibold leading-6 text-gray-900">Status*</label>
                <div class="mt-2.5">
                    <div>
                        <input type="radio" name="status" id="active" value="1" class="mr-2" {{ old('status') == '1' ? 'checked' : '' }}>
                        <label for="active" class="text-gray-900">Active</label>
                    </div>
                    <div>
                        <input type="radio" name="status" id="inactive" value="0" class="mr-2" {{ old('status') == '0' ? 'checked' : '' }}>
                        <label for="inactive" class="text-gray-900">Inactive</label>
                    </div>
                    @if ($errors->has('status'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('status') }}</p>
                    @endif
                </div>
            </div>

            <!-- Group and Contact Fields -->
            <div>
                <label for="group_id" class="block text-sm font-semibold leading-6 text-gray-900">Group</label>
                <div class="mt-2.5">
                    <select name="group_id" id="group_id" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="" selected>Select Group</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="contact_id" class="block text-sm font-semibold leading-6 text-gray-900">Contact</label>
                <div class="mt-2.5">
                    <select name="contact_id" id="contact_id" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="" selected>Select Contact</option>
                        @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}" {{ old('contact_id') == $contact->id ? 'selected' : '' }}>{{ $contact->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-block rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-gray-900/10 hover:ring-gray-900/20">Save Event</button>
        </div>
    </form>
</div>
@endsection
