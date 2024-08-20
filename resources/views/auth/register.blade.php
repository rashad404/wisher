@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="{{ asset('images/logo-w.svg') }}" alt="Wisher.az">
        <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('messages.registration') }}</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            <!-- First Name -->
            <div>
                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.first_name') }}</label>
                <div class="mt-2">
                    <input value="{{ old('first_name') }}" id="first_name" name="first_name" type="text" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('first_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.last_name') }}</label>
                <div class="mt-2">
                    <input value="{{ old('last_name') }}" id="last_name" name="last_name" type="text" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('last_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.gender') }}</label>
                <div class="mt-2">
                    <select value="{{ old('gender') }}" id="gender" name="gender" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="Male">{{ __('messages.male') }}</option>
                        <option value="Female">{{ __('messages.female') }}</option>
                        <option value="Other">{{ __('messages.other') }}</option>
                    </select>
                </div>
                @error('gender')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Date of Birth -->
            <div>
                <label for="dob" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.dob') }}</label>
                <div class="mt-2">
                    <input value="{{ old('dob') }}" id="dob" name="dob" type="date" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('dob')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.email_address') }}</label>
                <div class="mt-2">
                    <input value="{{ old('email') }}" id="email" name="email" type="email" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.password') }}</label>
                <div class="mt-2">
                    <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('messages.register') }}</button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            {{ __('messages.already_member') }}
            <a href="{{ route('login') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">{{ __('messages.log_in') }}</a>
        </p>
    </div>
</div>
@endsection
