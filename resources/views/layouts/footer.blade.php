<footer class="bg-[#E9654B] text-white py-16" aria-labelledby="footer-heading">
  <h2 id="footer-heading" class="sr-only">{{ __('messages.footer_heading') }}</h2>
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Logo and Description -->
          <div>
              <a href="/" class="flex items-center">
                  <img src="{{ asset('images/logo.svg') }}" alt="Wisher.az" class="h-10">
              </a>
              <p class="mt-4 text-sm">
                  {{ __('messages.footer_description') }}
              </p>
              <!-- Social Media Icons -->
              <div class="mt-6 flex space-x-4">
                  <a href="https://facebook.com/yourpage" class="text-white hover:text-gray-200">
                      <span class="sr-only">{{ __('messages.facebook') }}</span>
                      <!-- Facebook Icon -->
                      <i class="fab fa-facebook-f h-5 w-5"></i>
                  </a>
                  <a href="https://instagram.com/yourpage" class="text-white hover:text-gray-200">
                      <span class="sr-only">{{ __('messages.instagram') }}</span>
                      <!-- Instagram Icon -->
                      <i class="fab fa-instagram h-5 w-5"></i>
                  </a>
                  <a href="https://twitter.com/yourpage" class="text-white hover:text-gray-200">
                      <span class="sr-only">{{ __('messages.twitter') }}</span>
                      <!-- Twitter Icon -->
                      <i class="fab fa-twitter h-5 w-5"></i>
                  </a>
                  <a href="https://github.com/yourpage" class="text-white hover:text-gray-200">
                      <span class="sr-only">{{ __('messages.github') }}</span>
                      <!-- GitHub Icon -->
                      <i class="fab fa-github h-5 w-5"></i>
                  </a>
              </div>
          </div>
          <!-- Quick Links -->
          <div class="grid grid-cols-2 gap-8">
              <div>
                  <h3 class="text-base font-semibold">{{ __('messages.quick_links') }}</h3>
                  <ul class="mt-4 space-y-2">
                      <li>
                          <a href="{{ route('main.about') }}" class="text-sm hover:text-gray-200">{{ __('messages.about_us') }}</a>
                      </li>
                      <li>
                          <a href="{{ route('main.howItWorks') }}" class="text-sm hover:text-gray-200">{{ __('messages.how_it_works') }}</a>
                      </li>
                      <li>
                          <a href="{{ route('gifts.index') }}" class="text-sm hover:text-gray-200">{{ __('messages.gifts') }}</a>
                      </li>
                      <li>
                          <a href="{{ route('testimonials.index') }}" class="text-sm hover:text-gray-200">{{ __('messages.testimonials') }}</a>
                      </li>
                      <li>
                          <a href="/pricing" class="text-sm hover:text-gray-200">{{ __('messages.pricing') }}</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h3 class="text-base font-semibold">{{ __('messages.support') }}</h3>
                  <ul class="mt-4 space-y-2">
                      <li>
                          <a href="{{ route('password.request') }}" class="text-sm hover:text-gray-200">{{ __('messages.forgot_password') }}</a>
                      </li>
                      <li>
                          <a href="/contact" class="text-sm hover:text-gray-200">{{ __('messages.contact_us') }}</a>
                      </li>
                      <li>
                          <a href="/faq" class="text-sm hover:text-gray-200">{{ __('messages.faq') }}</a>
                      </li>
                      <li>
                          <a href="/blog" class="text-sm hover:text-gray-200">{{ __('messages.blog') }}</a>
                      </li>
                      <li>
                          <a href="{{ route('user.index') }}" class="text-sm hover:text-gray-200">{{ __('messages.dashboard') }}</a>
                      </li>
                  </ul>
              </div>
          </div>
          <!-- Newsletter Subscription -->
          <div>
              <h3 class="text-base font-semibold">{{ __('messages.subscribe_newsletter') }}</h3>
              <p class="mt-4 text-sm">
                  {{ __('messages.newsletter_text') }}
              </p>
              <form action="{{ route('subscribe') }}" method="POST" class="mt-6">
                  @csrf
                  <div class="flex flex-col sm:flex-row sm:items-center">
                      <input type="email" name="email" id="email" required class="w-full px-4 py-2 rounded-md text-gray-800" placeholder="{{ __('messages.enter_email') }}">
                      <button type="submit" class="mt-2 sm:mt-0 sm:ml-2 px-4 py-2 bg-white text-[#E9654B] rounded-md font-semibold hover:bg-gray-200">
                          {{ __('messages.subscribe') }}
                      </button>
                  </div>
              </form>
              @if(session('success'))
                  <div class="mt-4 text-sm text-green-500">
                      {{ session('success') }}
                  </div>
              @endif
          </div>
      </div>
      <!-- Bottom Footer -->
      <div class="mt-12 border-t border-white/20 pt-6">
          <p class="text-center text-sm">&copy; {{ date('Y') }} Wisher.az. {{ __('messages.all_rights_reserved') }}</p>
      </div>
  </div>
</footer>
