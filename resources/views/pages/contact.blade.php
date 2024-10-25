@extends('layouts.app')

@section('title', __('messages.contact_us_title') . ' | ' . config('app.name'))

@section('content')
<div class="relative isolate bg-white">

  <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
    <!-- Contact Information Section -->
    <div class="relative px-6 pb-20 pt-24 sm:pt-32 lg:static lg:px-8 lg:py-48">
      <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
        <h2 class="text-4xl font-bold tracking-tight text-gray-900">{{ __('messages.get_in_touch') }}</h2>
        <p class="mt-6 text-lg leading-8 text-gray-600">{{ __('messages.contact_intro') }}</p>

        <!-- Contact Details with Icons -->
        <div class="mt-10 space-y-6 text-lg leading-7 text-gray-600">
          <div class="flex items-center gap-x-4">
            <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9C3.75 4.719 7.5 1.5 12 1.5s8.25 3.219 8.25 7.5c0 3.75-3.404 6.768-7.835 10.537-.456.38-1.12.38-1.577 0C7.154 15.768 3.75 12.75 3.75 9z" />
            </svg>
            <div>
              <h3 class="font-bold text-gray-900">{{ __('messages.address') }}</h3>
              <p>123 Example Street<br>Baku, Azerbaijan</p>
            </div>
          </div>

          <div class="flex items-center gap-x-4">
            <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
            </svg>
            <div>
              <h3 class="font-bold text-gray-900">{{ __('messages.telephone') }}</h3>
              <p><a href="tel:+994551234567" class="text-[#E9654B] hover:text-gray-900">+994 55 123 45 67</a></p>
            </div>
          </div>

          <div class="flex items-center gap-x-4">
            <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
            <div>
              <h3 class="font-bold text-gray-900">{{ __('messages.email') }}</h3>
              <p><a href="mailto:support@wisher.az" class="text-[#E9654B] hover:text-gray-900">support@wisher.az</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Form Section -->
    <form action="{{ route('contact.submit') }}" method="POST" class="px-6 pb-24 pt-20 sm:pb-32 lg:px-12 lg:py-48 bg-gray-50 rounded-lg shadow-lg">
      @csrf
      <div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
        @if(session('success'))
          <div class="mb-4 text-green-600 bg-green-100 p-4 rounded-md">
              {{ session('success') }}
          </div>
        @endif

        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
          <!-- First Name -->
          <div>
            <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.first_name') }}</label>
            <div class="mt-2.5">
              <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-gray-300 px-3 py-2 text-gray-900 shadow-sm bg-gray-50 hover:bg-white focus:bg-white focus:ring-2 focus:ring-[#E9654B] transition-all sm:text-sm sm:leading-6" required>
            </div>
          </div>

          <!-- Last Name -->
          <div>
            <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.last_name') }}</label>
            <div class="mt-2.5">
              <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-gray-300 px-3 py-2 text-gray-900 shadow-sm bg-gray-50 hover:bg-white focus:bg-white focus:ring-2 focus:ring-[#E9654B] transition-all sm:text-sm sm:leading-6" required>
            </div>
          </div>

          <!-- Email -->
          <div class="sm:col-span-2">
            <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.email') }}</label>
            <div class="mt-2.5">
              <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-gray-300 px-3 py-2 text-gray-900 shadow-sm bg-gray-50 hover:bg-white focus:bg-white focus:ring-2 focus:ring-[#E9654B] transition-all sm:text-sm sm:leading-6" required>
            </div>
          </div>

          <!-- Phone Number -->
          <div class="sm:col-span-2">
            <label for="phone-number" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.phone_number') }}</label>
            <div class="mt-2.5">
              <input type="tel" name="phone-number" id="phone-number" autocomplete="tel" class="block w-full rounded-md border-gray-300 px-3 py-2 text-gray-900 shadow-sm bg-gray-50 hover:bg-white focus:bg-white focus:ring-2 focus:ring-[#E9654B] transition-all sm:text-sm sm:leading-6">
            </div>
          </div>

          <!-- Message -->
          <div class="sm:col-span-2">
            <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.message') }}</label>
            <div class="mt-2.5">
              <textarea name="message" id="message" rows="4" class="block w-full rounded-md border-gray-300 px-3 py-2 text-gray-900 shadow-sm bg-gray-50 hover:bg-white focus:bg-white focus:ring-2 focus:ring-[#E9654B] transition-all sm:text-sm sm:leading-6" required></textarea>
            </div>
          </div>
        </div>

        <!-- Redesigned Submit Button -->
        <div class="mt-8 flex justify-end">
            <button type="submit" class="rounded-md bg-[#E9654B] px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#d45a43] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E9654B] transition-all">
                {{ __('messages.send_message') }}
            </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
