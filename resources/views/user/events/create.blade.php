@extends('layouts.user.app')

@section('content')
<div class="container">
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

            <!-- Recurrence Fields -->
            <div>
                <label class="block text-sm font-semibold leading-6 text-gray-900">Recurrence</label>
                <div class="mt-2.5">
                    <div>
                        <input type="radio" name="recurrence" id="is_annual" value="annual" class="mr-2" {{ old('recurrence') == 'annual' ? 'checked' : '' }}>
                        <label for="is_annual" class="text-gray-900">Annual</label>
                    </div>
                    <div>
                        <input type="radio" name="recurrence" id="is_monthly" value="monthly" class="mr-2" {{ old('recurrence') == 'monthly' ? 'checked' : '' }}>
                        <label for="is_monthly" class="text-gray-900">Monthly</label>
                    </div>
                    @if ($errors->has('recurrence'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('recurrence') }}</p>
                    @endif
                </div>
            </div>

            <!-- Status Field (Active/Inactive) -->
            <div>
                <label class="block text-sm font-semibold leading-6 text-gray-900">Status*</label>
                <div class="mt-2.5">
                    <div>
                        <input type="radio" name="status" id="active" value="active" class="mr-2" required {{ old('status') == 'active' ? 'checked' : '' }}>
                        <label for="active" class="text-gray-900">Active</label>
                    </div>
                    <div>
                        <input type="radio" name="status" id="inactive" value="inactive" class="mr-2" required {{ old('status') == 'inactive' ? 'checked' : '' }}>
                        <label for="inactive" class="text-gray-900">Inactive</label>
                    </div>
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
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
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
                            <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-10">
            <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create Important Date</button>
        </div>
    </form>
</div>
@endsection
