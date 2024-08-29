<footer class="bg-[#331E6D]" aria-labelledby="footer-heading">
  <h2 id="footer-heading" class="sr-only">{{ __('messages.footer_heading') }}</h2>
  <div class="mx-auto max-w-7xl px-6 pb-8 pt-20 sm:pt-24 lg:px-8 lg:pt-32">
    <div class="xl:grid xl:grid-cols-3 xl:gap-8">
      <div class="grid grid-cols-2 gap-8 xl:col-span-2">
        <div class="md:grid md:grid-cols-2 md:gap-8">
          <div>
            <h3 class="text-sm font-semibold leading-6 text-white">{{ __('messages.quick_links') }}</h3>
            <ul role="list" class="mt-6 space-y-4">
              <li>
                <a href="{{ route('main.about') }}" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.about_us') }}</a>
              </li>
              <li>
                <a href="{{ route('main.howItWorks') }}" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.how_it_works') }}</a>
              </li>
              <li>
                <!--The products section may change in the future-->
                <a href="{{ route('products.index') }}" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.gifts') }}</a>
              </li>
              <!--
              <li>
                <a href="{{ route('products.index') }}" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.products') }}</a>
              </li>
               -->
              <li>
                <a href="{{ route('testimonials.index') }}" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.testimonials') }}</a>
              </li>
            </ul>
          </div>
          <div class="mt-10 md:mt-0">
            <h3 class="text-sm font-semibold leading-6 text-white">{{ __('messages.support') }}</h3>
            <ul role="list" class="mt-6 space-y-4">
              <li>
                <a href="{{ route('password.request') }}" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.forgot_password') }}</a>
              </li>
              <li>
                <a href="/contact" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.contact_us') }}</a>
              </li>
              <li>
                <a href="/faq" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.faq') }}</a>
              </li>
              <li>
                <a href="/pricing" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.pricing') }}</a>
              </li>
              <li>
                <a href="/blog" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.blog') }}</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="md:grid md:grid-cols-2 md:gap-8">
          <div>
            <h3 class="text-sm font-semibold leading-6 text-white">{{ __('messages.account') }}</h3>
            <ul role="list" class="mt-6 space-y-4">
              <li>
                <a href="{{ route('login') }}" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.login') }}</a>
              </li>
              <li>
                <a href="{{ route('register') }}" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.register') }}</a>
              </li>
              <li>
                <a href="{{ route('user.index') }}" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.dashboard') }}</a>
              </li>
            </ul>
          </div>
          <div class="mt-10 md:mt-0">
            <h3 class="text-sm font-semibold leading-6 text-white">{{ __('messages.legal') }}</h3>
            <ul role="list" class="mt-6 space-y-4">
              <li>
                <a href="/privacy-policy" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.privacy_policy') }}</a>
              </li>
              <li>
                <a href="/terms" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('messages.terms_of_service') }}</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="mt-10 xl:mt-0">
        <h3 class="text-sm font-semibold leading-6 text-white">{{ __('messages.subscribe_newsletter') }}</h3>
        <p class="mt-2 text-sm leading-6 text-gray-300">{{ __('messages.newsletter_text') }}</p>
        <form action="{{ route('subscribe') }}" method="POST" class="mt-6 sm:flex sm:max-w-md">
          @csrf
          <label for="email-address" class="sr-only">{{ __('messages.email_address') }}</label>
          <input type="email" name="email" id="email-address" autocomplete="email" required class="w-full min-w-0 appearance-none rounded-md border-0 bg-white/5 px-3 py-1.5 text-base text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:w-64 sm:text-sm sm:leading-6 xl:w-full" placeholder="{{ __('messages.enter_email') }}">
          <div class="mt-4 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
            <button type="submit" class="flex w-full items-center justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">{{ __('messages.subscribe') }}</button>
          </div>
        </form>
        @if(session('success'))
          <div class="mt-4 text-sm text-green-500">
            {{ session('success') }}
          </div>
        @endif

      </div>
    </div>
    <div class="mt-16 border-t border-white/10 pt-8 sm:mt-20 md:flex md:items-center md:justify-between lg:mt-24">
      <div class="flex space-x-6 md:order-2">
        <a href="https://facebook.com/yourpage" class="text-gray-500 hover:text-gray-400">
          <span class="sr-only">{{ __('messages.facebook') }}</span>
          <!-- Facebook SVG Icon -->
        </a>
        <a href="https://instagram.com/yourpage" class="text-gray-500 hover:text-gray-400">
          <span class="sr-only">{{ __('messages.instagram') }}</span>
          <!-- Instagram SVG Icon -->
        </a>
        <a href="https://twitter.com/yourpage" class="text-gray-500 hover:text-gray-400">
          <span class="sr-only">{{ __('messages.twitter') }}</span>
          <!-- Twitter SVG Icon -->
        </a>
        <a href="https://github.com/yourpage" class="text-gray-500 hover:text-gray-400">
          <span class="sr-only">{{ __('messages.github') }}</span>
          <!-- GitHub SVG Icon -->
        </a>
      </div>
      <p class="mt-8 text-xs leading-5 text-gray-400 md:order-1 md:mt-0">&copy; {{ date('Y') }} wisher.az | {{ __('messages.all_rights_reserved') }}</p>
    </div>
  </div>
</footer>
