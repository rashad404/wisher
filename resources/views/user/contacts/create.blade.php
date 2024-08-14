@extends('layouts.user.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold text-gray-900">Create a New Contact</h1>
    <form method="POST" action="{{ route('user.contacts.store') }}" class="max-w-xl sm:mt-10">
        @csrf
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">Name*</label>
                <div class="mt-2.5">
                    <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                <div class="mt-2.5">
                    <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('email') }}</p>
                    @endif
                </div>
            </div>

            <!-- Phone Number Field -->
            <div>
                <label for="phone_number" class="block text-sm font-semibold leading-6 text-gray-900">Phone Number</label>
                <div class="relative mt-2.5">
                    <div class="absolute inset-y-0 left-0 flex items-center">
                        <label for="country" class="sr-only">Country</label>
                        <select id="country" name="country" class="h-full rounded-md border-0 bg-transparent bg-none py-0 pl-4 pr-9 text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>US</option>
                            <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>CA</option>
                            <option value="EU" {{ old('country') == 'EU' ? 'selected' : '' }}>EU</option>
                        </select>
                        <svg class="pointer-events-none absolute right-3 top-0 h-full w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="tel" name="phone_number" id="phone_number" autocomplete="tel" class="block w-full rounded-md border-0 px-3.5 py-2 pl-20 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('phone_number') }}">
                    @if ($errors->has('phone_number'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('phone_number') }}</p>
                    @endif
                </div>
            </div>

            <!-- Birthdate Field -->
            <div class="space-y-2 sm:col-span-2">
              <label class="block text-sm font-medium text-gray-700">Birthdate</label>
              <div class="flex items-center space-x-2">
                  <div class="relative flex-1">
                      <select name="birth_day" class="block w-full rounded-md border-gray-300 pl-3 pr-10 py-2 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option value="">Day</option>
                          @for ($i = 1; $i <= 31; $i++)
                              <option value="{{ $i }}" {{ old('birth_day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                          @endfor
                      </select>
                  </div>
                  <span class="text-gray-500 px-2">-</span>
                  <div class="relative flex-1">
                      <select name="birth_month" class="block w-full rounded-md border-gray-300 pl-3 pr-10 py-2 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option value="">Month</option>
                          @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                              <option value="{{ $loop->iteration }}" {{ old('birth_month') == $loop->iteration ? 'selected' : '' }}>{{ $month }}</option>
                          @endforeach
                      </select>
                  </div>
                  <span class="text-gray-500 px-2">-</span>
                  <div class="relative flex-1">
                      <select name="birth_year" class="block w-full rounded-md border-gray-300 pl-3 pr-10 py-2 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option value="">Year</option>
                          @for ($i = date('Y'); $i >= 1950; $i--)
                              <option value="{{ $i }}" {{ old('birth_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                          @endfor
                      </select>
                  </div>
              </div>
              @if ($errors->has('birth_day') || $errors->has('birth_month') || $errors->has('birth_year'))
                  <p class="mt-2 text-sm text-red-600">{{ $errors->first('birth_day') ?: $errors->first('birth_month') ?: $errors->first('birth_year') }}</p>
              @endif
            </div>

            <!-- Address Field -->
            <div class="sm:col-span-2">
                <label for="address" class="block text-sm font-semibold leading-6 text-gray-900">Address</label>
                <div class="mt-2.5">
                  <input type="text" name="address" id="address" autocomplete="address" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('address') }}">
                    @if ($errors->has('address'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('address') }}</p>
                    @endif
                </div>
            </div>

            <!-- Groups Field -->
            <div class="sm:col-span-2">
                <label for="groups" class="block text-sm font-semibold leading-6 text-gray-900">Groups</label>
                <div class="mt-2.5">
                    <select name="groups[]" id="groups" multiple class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-10">
            <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create Contact</button>
        </div>
    </form>
</div>
@endsection