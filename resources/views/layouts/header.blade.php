<header class="bg-[#331E6D]">
    <nav class="mx-auto flex max-w-7xl items-center justify-between gap-x-6 p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="/" class="-m-1.5 p-1.5">
                <span class="sr-only">Wisher.az</span>
                <img class="w-32" src="{{ asset('images/logo.svg') }}" alt="Wisher.az">
            </a>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="/" class="text-sm font-semibold leading-6 text-white">{{ __('messages.home') }}</a>
            <a href="/wishes" class="text-sm font-semibold leading-6 text-white">{{ __('messages.wishes') }}</a>
            <!--The /products section may change in the future-->
            <a href="/products" class="text-sm font-semibold leading-6 text-white">{{ __('messages.gifts') }}</a>
            <a href="/features" class="text-sm font-semibold leading-6 text-white">{{ __('messages.features') }}</a>
            <a href="/how-it-works" class="text-sm font-semibold leading-6 text-white">{{ __('messages.how_it_works') }}</a>
            <a href="/pricing" class="text-sm font-semibold leading-6 text-white">{{ __('messages.pricing') }}</a>
            <a href="/about" class="text-sm font-semibold leading-6 text-white">{{ __('messages.about_us') }}</a>
            <a href="/contact" class="text-sm font-semibold leading-6 text-white">{{ __('messages.contact_us') }}</a>
            <a href="/blog" class="text-sm font-semibold leading-6 text-white">{{ __('messages.blog') }}</a>
        </div>
        <div class="flex flex-1 items-center justify-end gap-x-6">
            <!-- Language Dropdown -->
            <div class="relative z-50">
                <button type="button" class="text-white text-sm font-semibold leading-6 focus:outline-none" id="languageButton">
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" id="languageDropdown">
                    <div class="py-1">
                        <a href="{{ route('switchLang', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.english') }}
                        </a>
                        <a href="{{ route('switchLang', 'az') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.azerbaijani') }}
                        </a>
                        <a href="{{ route('switchLang', 'es') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.spanish') }}
                        </a>
                        <a href="{{ route('switchLang', 'fr') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.french') }}
                        </a>
                        <a href="{{ route('switchLang', 'de') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.german') }}
                        </a>
                        <a href="{{ route('switchLang', 'pt') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.portuguese') }}
                        </a>
                        <a href="{{ route('switchLang', 'ru') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.russian') }}
                        </a>
                        <a href="{{ route('switchLang', 'zh-CN') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.chinese') }}
                        </a>
                        <a href="{{ route('switchLang', 'ar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.arabic') }}
                        </a>
                        <a href="{{ route('switchLang', 'hi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.hindi') }}
                        </a>
                        <a href="{{ route('switchLang', 'ja') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.japanese') }}
                        </a>
                        <a href="{{ route('switchLang', 'it') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('messages.italian') }}
                        </a>
                    </div>
                </div>

            </div>

            @auth
                <!-- User Profile with Photo and Dropdown -->
                <div class="relative">
                    <button type="button" class="flex items-center space-x-2 text-white text-sm font-semibold leading-6 focus:outline-none" id="userDropdownButton">
                        <img src="{{ Storage::url(auth()->user()->profile->profile_photo ?? 'images/user.png') }}" class="w-8 h-8 rounded-full" alt="{{ auth()->user()->name() }}">
                        <span>{{ auth()->user()->name() }}</span>
                        <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="userDropdownMenu" class="z-50 hidden absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <a href="{{ route('user.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            {{ __('Your Profile') }}
                        </a>
                        <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            {{ __('Settings') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            @csrf
                            <button type="submit" class="w-full text-left">{{ __('Sign out') }}</button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Show Login and Sign Up buttons if not logged in -->
                <a href="/login" class="hidden lg:block lg:text-sm lg:font-semibold lg:leading-6 lg:text-white">{{ __('messages.log_in') }}</a>
                <a href="/register" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ __('messages.sign_up') }}
                </a>
            @endauth
        </div>
        <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white" id="mobileMenuButton" aria-expanded="false" aria-label="Open main menu">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </nav>
    <!-- Mobile menu -->
    <div class="hidden lg:hidden z-50" role="dialog" aria-modal="true" id="mobileMenu">
        <div class="absolute inset-0 bg-black opacity-50 z-10" id="menuOverlay"></div>

        <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between bg-[#331E6D] px-6 py-8">
                <a href="/" class="-m-1.5 p-1.5">
                    <span class="sr-only">Wisher.az</span>
                    <img class="w-32" src="{{ asset('images/logo.svg') }}" alt="Wisher.az">
                </a>
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-white" id="closeMobileMenu" aria-label="Close menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root  px-6 py-6">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="/" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('messages.home') }}</a>
                        <a href="/features" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('messages.features') }}</a>
                        <a href="/how-it-works" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('messages.how_it_works') }}</a>
                        <a href="/pricing" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('messages.pricing') }}</a>
                        <a href="/about" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('messages.about_us') }}</a>
                        <a href="/contact" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('messages.contact_us') }}</a>
                        <a href="/blog" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('messages.blog') }}</a>
                    </div>
                    <div class="py-6">
                        @auth
                            <div class="flex items-center space-x-4">
                                <!-- Profile Photo -->
                                <img src="{{ Storage::url(auth()->user()->profile->profile_photo ?? 'images/user.png') }}" class="w-8 h-8 rounded-full" alt="{{ auth()->user()->name() }}">

                                <!-- User Name -->
                                <span class="text-base font-semibold text-gray-900">{{ auth()->user()->name() }}</span>

                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 block w-full text-left">
                                        {{ __('messages.log_out') }}
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="/login" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('messages.log_in') }}</a>
                        @endauth
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

<script>
    document.getElementById('languageButton').addEventListener('click', function() {
        var dropdown = document.getElementById('languageDropdown');
        dropdown.classList.toggle('hidden');
    });

    const menuOverlay = document.getElementById('menuOverlay');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const closeMobileMenu = document.getElementById('closeMobileMenu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
    });

    closeMobileMenu.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
    });

    menuOverlay.addEventListener('click', function () {
        mobileMenu.classList.add('hidden');
    });

    // Dropdown toggle for user menu
    document.getElementById('userDropdownButton').addEventListener('click', function() {
        var dropdown = document.getElementById('userDropdownMenu');
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('userDropdownMenu');
        var button = document.getElementById('userDropdownButton');
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
