@extends('layouts.user.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold text-gray-900">Edit Important Date</h1>
    <form method="POST" action="{{ route('user.events.update', $event->id) }}" class="max-w-xl sm:mt-10">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <!-- Event Name Field -->
            <div>
                <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">Name*</label>
                <div class="mt-2.5">
                    <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="{{ old('name', $event->name) }}">
                    @if ($errors->has('name'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>

            <!-- Date Field -->
            <div>
                <label for="date" class="block text-sm font-semibold leading-6 text-gray-900">Date*</label>
                <div class="mt-2.5">
                    <input type="date" name="date" id="date" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="{{ old('date', $event->date) }}">
                    @if ($errors->has('date'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('date') }}</p>
                    @endif
                </div>
            </div>

            <!-- Recurrence Field -->
            <div>
                <label for="recurrence" class="block text-sm font-semibold leading-6 text-gray-900">Recurrence</label>
                <div class="mt-2.5">
                    <select name="recurrence" id="recurrence" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="0" {{ old('recurrence', $event->recurrence) == 0 ? 'selected' : '' }}>None</option>
                        <option value="1" {{ old('recurrence', $event->recurrence) == 1 ? 'selected' : '' }}>Annual</option>
                        <option value="2" {{ old('recurrence', $event->recurrence) == 2 ? 'selected' : '' }}>Monthly</option>
                    </select>
                    @if ($errors->has('recurrence'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('recurrence') }}</p>
                    @endif
                </div>
            </div>

            <!-- Status Field -->
            <div>
                <label for="status" class="block text-sm font-semibold leading-6 text-gray-900">Status*</label>
                <div class="mt-2.5">
                    <select name="status" id="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" required>
                        <option value="1" {{ old('status', $event->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $event->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @if ($errors->has('status'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('status') }}</p>
                    @endif
                </div>
            </div>

            <!-- Groups Field -->
            <div>
                <label for="group_id" class="block text-sm font-semibold leading-6 text-gray-900">Group</label>
                <div class="mt-2.5">
                    <select name="group_id" id="group_id" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">Select Group (Optional)</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ old('group_id', $event->group_id) == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Contacts Field -->
            <div>
                <label for="contact_id" class="block text-sm font-semibold leading-6 text-gray-900">Contact</label>
                <div class="mt-2.5">
                    <select name="contact_id" id="contact_id" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">Select Contact (Optional)</option>
                        @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}" {{ old('contact_id', $event->contact_id) == $contact->id ? 'selected' : '' }}>{{ $contact->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-10">
            <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save Changes</button>
        </div>
    </form>
</div>
@endsection
