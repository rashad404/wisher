<header class="bg-[#331E6D]">
  <nav class="mx-auto flex max-w-7xl items-center justify-between gap-x-6 p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
          <a href="/" class="-m-1.5 p-1.5">
              <span class="sr-only">Wisher.az</span>
              <img class="w-32" src="{{ asset('images/logo.svg') }}" alt="Wisher.az">
          </a>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
          <a href="/" class="text-sm font-semibold leading-6 text-white">Home</a>
          <a href="/features" class="text-sm font-semibold leading-6 text-white">Features</a>
          <a href="/how-it-works" class="text-sm font-semibold leading-6 text-white">How It Works</a>
          <a href="/pricing" class="text-sm font-semibold leading-6 text-white">Pricing</a>
          <a href="/about" class="text-sm font-semibold leading-6 text-white">About Us</a>
          <a href="/contact" class="text-sm font-semibold leading-6 text-white">Contact Us</a>
          <a href="/blog" class="text-sm font-semibold leading-6 text-white">Blog</a>
      </div>
      <div class="flex flex-1 items-center justify-end gap-x-6">
          <a href="/login" class="hidden lg:block lg:text-sm lg:font-semibold lg:leading-6 lg:text-white">Log In</a>
          <a href="/register" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign Up</a>
      </div>
      <div class="flex lg:hidden">
          <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" aria-expanded="false" aria-label="Open main menu">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
          </button>
      </div>
  </nav>
  <!-- Mobile menu -->
  <div class="hidden lg:hidden" role="dialog" aria-modal="true">
      <!-- Background backdrop -->
      <div class="fixed inset-0 z-10"></div>
      <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center gap-x-6">
              <a href="/" class="-m-1.5 p-1.5">
                  <span class="sr-only">Wisher.az</span>
                  <img class="h-8 w-auto" src="{{ asset('images/logo.svg') }}" alt="Wisher.az">
              </a>
              <a href="/register" class="ml-auto rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign Up</a>
              <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" aria-label="Close menu">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
              </button>
          </div>
          <div class="mt-6 flow-root">
              <div class="-my-6 divide-y divide-gray-500/10">
                  <div class="space-y-2 py-6">
                      <a href="/" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Home</a>
                      <a href="/features" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
                      <a href="/how-it-works" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">How It Works</a>
                      <a href="/pricing" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Pricing</a>
                      <a href="/about" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">About Us</a>
                      <a href="/contact" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Contact Us</a>
                      <a href="/blog" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Blog</a>
                  </div>
                  <div class="py-6">
                      <a href="/login" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log In</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</header>

{{-- Notification Messages --}}
@if(session('success') || session('error'))
  <div class="rounded-md p-4 {{ session('success') ? 'bg-green-50' : 'bg-red-50' }}">
      <div class="flex">
          <div class="flex-shrink-0">
              <svg class="h-5 w-5 {{ session('success') ? 'text-green-400' : 'text-red-400' }}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
              </svg>
          </div>
          <div class="ml-3">
              <p class="text-sm font-medium {{ session('success') ? 'text-green-800' : 'text-red-800' }}">{{ session('success') ?? session('error') }}</p>
          </div>
          <div class="ml-auto pl-3">
              <button type="button" class="inline-flex rounded-md p-1.5 {{ session('success') ? 'bg-green-50 text-green-500 hover:bg-green-100 focus:ring-green-600' : 'bg-red-50 text-red-500 hover:bg-red-100 focus:ring-red-600' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-{{ session('success') ? 'green-50' : 'red-50' }}">
                  <span class="sr-only">Dismiss</span>
                  <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                  </svg>
              </button>
          </div>
      </div>
  </div>
@endif
