@extends('layouts.app')

@section('title', __('messages.contact_us_title') . ' | ' . config('app.name'))

@section('content')
<div class="relative isolate bg-white">

  <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
    <!-- Contact Information Section -->
    <div class="relative px-6 pb-20 pt-24 sm:pt-32 lg:static lg:px-8 lg:py-48">
      <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
        <div class="absolute inset-y-0 left-0 -z-10 w-full overflow-hidden bg-gray-100 ring-1 ring-gray-900/10 lg:w-1/2">
          <svg class="absolute inset-0 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
            <defs>
              <pattern id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="100%" y="-1" patternUnits="userSpaceOnUse">
                <path d="M130 200V.5M.5 .5H200" fill="none" />
              </pattern>
            </defs>
            <rect width="100%" height="100%" stroke-width="0" fill="white" />
            <svg x="100%" y="-1" class="overflow-visible fill-gray-50">
              <path d="M-470.5 0h201v201h-201Z" stroke-width="0" />
            </svg>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" />
          </svg>
        </div>
        <h2 class="text-3xl font-bold tracking-tight text-gray-900">{{ __('messages.get_in_touch') }}</h2>
        <p class="mt-6 text-lg leading-8 text-gray-600">{{ __('messages.contact_intro') }}</p>
        <dl class="mt-10 space-y-4 text-base leading-7 text-gray-600">
          <!-- Address -->
          <div class="flex gap-x-4">
            <dt class="flex-none">
              <span class="sr-only">{{ __('messages.address') }}</span>
              <svg class="h-7 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
              </svg>
            </dt>
            <dd>123 Example Street<br>Baku, Azerbaijan</dd>
          </div>
          <!-- Telephone -->
          <div class="flex gap-x-4">
            <dt class="flex-none">
              <span class="sr-only">{{ __('messages.telephone') }}</span>
              <svg class="h-7 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
              </svg>
            </dt>
            <dd><a class="hover:text-gray-900" href="tel:+994551234567">+994 55 123 45 67</a></dd>
          </div>
          <!-- Email -->
          <div class="flex gap-x-4">
            <dt class="flex-none">
              <span class="sr-only">{{ __('messages.email') }}</span>
              <svg class="h-7 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
              </svg>
            </dt>
            <dd><a class="hover:text-gray-900" href="mailto:support@wisher.az">support@wisher.az</a></dd>
          </div>
        </dl>
      </div>
    </div>

    <!-- Contact Form Section -->
    <form action="{{ route('contact.submit') }}" method="POST" class="px-6 pb-24 pt-20 sm:pb-32 lg:px-8 lg:py-48">
      @csrf
      <div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
        @if(session('success'))
          <div class="mb-4 text-green-600">
              {{ session('success') }}
          </div>
        @endif
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
          <!-- First Name -->
          <div>
            <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.first_name') }}</label>
            <div class="mt-2.5">
              <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6" required>
            </div>
          </div>

          <!-- Last Name -->
          <div>
            <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.last_name') }}</label>
            <div class="mt-2.5">
              <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6" required>
            </div>
          </div>

          <!-- Email -->
          <div class="sm:col-span-2">
            <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.email') }}</label>
            <div class="mt-2.5">
              <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6" required>
            </div>
          </div>

          <!-- Phone Number -->
          <div class="sm:col-span-2">
            <label for="phone-number" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.phone_number') }}</label>
            <div class="mt-2.5">
              <input type="tel" name="phone-number" id="phone-number" autocomplete="tel" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6">
            </div>
          </div>

          <!-- Message -->
          <div class="sm:col-span-2">
            <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">{{ __('messages.message') }}</label>
            <div class="mt-2.5">
              <textarea name="message" id="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#E9654B] sm:text-sm sm:leading-6" required></textarea>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-8 flex justify-end">
            <button type="submit" class="rounded-md bg-[#E9654B] px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#d45a43] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#E9654B]">
                {{ __('messages.send_message') }}
            </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
