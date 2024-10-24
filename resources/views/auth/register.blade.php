@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 bg-gray-50">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="{{ asset('images/logo-w.svg') }}" alt="Wisher.az">
        <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('messages.registration') }}</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md bg-white p-8 rounded-xl shadow-lg">
        <form class="space-y-6" action="{{ route('register') }}" method="POST">
            @csrf

            <!-- First Name -->
            <div>
                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.first_name') }}</label>
                <div class="mt-2">
                    <input value="{{ old('first_name') }}" id="first_name" name="first_name" type="text" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6">
                </div>
                @error('first_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.last_name') }}</label>
                <div class="mt-2">
                    <input value="{{ old('last_name') }}" id="last_name" name="last_name" type="text" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6">
                </div>
                @error('last_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.gender') }}</label>
                <div class="mt-2">
                    <select value="{{ old('gender') }}" id="gender" name="gender" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6">
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
                    <input value="{{ old('dob') }}" id="dob" name="dob" type="date" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6">
                </div>
                @error('dob')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.email_address') }}</label>
                <div class="mt-2">
                    <input value="{{ old('email') }}" id="email" name="email" type="email" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6">
                </div>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password with Toggle -->
            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">{{ __('messages.password') }}</label>
                <div class="mt-2 relative">
                    <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-2 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6">
                    <div class="absolute inset-y-0 right-3 flex items-center">
                        <button type="button" onclick="togglePassword()" class="focus:outline-none">
                            <!-- Closed Eye SVG (Initially visible) -->
                            <svg id="eyeOpenIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                            <!-- Open Eye SVG (Initially hidden) -->
                            <svg id="eyeClosedIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-500 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-[#E9654B] px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-[#d45a43] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#E9654B]">{{ __('messages.register') }}</button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            {{ __('messages.already_member') }}
            <a href="{{ route('login') }}" class="font-semibold leading-6 text-[#E9654B] hover:text-[#d45a43]">{{ __('messages.log_in') }}</a>
        </p>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var eyeOpenIcon = document.getElementById("eyeOpenIcon");
        var eyeClosedIcon = document.getElementById("eyeClosedIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeOpenIcon.classList.add("hidden");
            eyeClosedIcon.classList.remove("hidden");
        } else {
            passwordInput.type = "password";
            eyeOpenIcon.classList.remove("hidden");
            eyeClosedIcon.classList.add("hidden");
        }
    }
</script>
@endsection
