@extends('layouts.user.app')

@section('content')
<div class="py-6">
    <!-- Breadcrumbs -->
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Home')],
        ['url' => route('user.contacts.index'), 'label' => __('Contacts')],
        ['url' => route('user.contacts.create'), 'label' => __('Create Contact')]
    ]"/>
</div>

<div class="container pt-8">
    <!-- Contact Form aligned to the left side -->
    <div class="max-w-3xl">
        <!-- Title -->
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Create a New Contact</h1>

        <!-- Form -->
        <form method="POST" action="{{ route('user.contacts.store') }}" class="space-y-6">
            @csrf

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name*</label>
                <input type="text" name="name" id="name" required
                       class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#E9654B] transition duration-150"
                       value="{{ old('name') }}">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email"
                       class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#E9654B] transition duration-150"
                       value="{{ old('email') }}">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number with Country -->
            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <div class="flex">
                    <!-- Select for Country -->
                    <select id="country" name="country"
                            class="rounded-l-md border border-gray-300 px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-[#E9654B] transition duration-150 appearance-none min-w-0">
                        <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>US</option>
                        <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>CA</option>
                        <option value="EU" {{ old('country') == 'EU' ? 'selected' : '' }}>EU</option>
                    </select>

                    <!-- Input for Phone Number -->
                    <input type="tel" name="phone_number" id="phone_number"
                           class="block w-full rounded-r-md border-l-0 border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#E9654B] transition duration-150 min-w-0"
                           value="{{ old('phone_number') }}">
                </div>
                @error('phone_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>


            <!-- Birthdate Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Birthdate</label>
                <div class="flex space-x-4">
                    <select name="birth_day" class="w-1/3 rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#E9654B]">
                        <option value="">Day</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}" {{ old('birth_day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    <select name="birth_month" class="w-1/3 rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#E9654B]">
                        <option value="">Month</option>
                        @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                            <option value="{{ $loop->iteration }}" {{ old('birth_month') == $loop->iteration ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                    <select name="birth_year" class="w-1/3 rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#E9654B]">
                        <option value="">Year</option>
                        @for ($i = date('Y'); $i >= 1950; $i--)
                            <option value="{{ $i }}" {{ old('birth_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                @error('birth_day')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address Field -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <input type="text" name="address" id="address"
                       class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#E9654B] transition duration-150"
                       value="{{ old('address') }}">
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Groups Field -->
            <div>
                <label for="groups" class="block text-sm font-medium text-gray-700 mb-2">Groups</label>
                <select name="groups[]" id="groups" multiple
                        class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#E9654B] transition duration-150">
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full px-6 py-3 bg-[#E9654B] text-white font-semibold rounded-lg shadow-md hover:bg-[#d45a43] transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E9654B]">
                    Create Contact
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
