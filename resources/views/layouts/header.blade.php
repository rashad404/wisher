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
            <a href="/features" class="text-sm font-semibold leading-6 text-white">{{ __('messages.features') }}</a>
            <a href="/how-it-works" class="text-sm font-semibold leading-6 text-white">{{ __('messages.how_it_works') }}</a>
            <a href="/pricing" class="text-sm font-semibold leading-6 text-white">{{ __('messages.pricing') }}</a>
            <a href="/about" class="text-sm font-semibold leading-6 text-white">{{ __('messages.about_us') }}</a>
            <a href="/contact" class="text-sm font-semibold leading-6 text-white">{{ __('messages.contact_us') }}</a>
            <a href="/blog" class="text-sm font-semibold leading-6 text-white">{{ __('messages.blog') }}</a>
        </div>
        <div class="flex flex-1 items-center justify-end gap-x-6">
            <!-- Language Dropdown -->
            <div class="relative">
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
                    </div>
                </div>
            </div>

            <a href="/login" class="hidden lg:block lg:text-sm lg:font-semibold lg:leading-6 lg:text-white">{{ __('messages.log_in') }}</a>
            <a href="/register" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('messages.sign_up') }}</a>
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
    <div class="hidden lg:hidden" role="dialog" aria-modal="true" id="mobileMenuBackdrop">
        <div class="absolute inset-0 bg-black opacity-50"></div>

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
                        <a href="/login" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ __('messages.log_in') }}</a>
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
    const mobileMenuBackdrop = document.getElementById('mobileMenuBackdrop');
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const closeMobileMenu = document.getElementById('closeMobileMenu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenuBackdrop.classList.remove('hidden');
    });

    closeMobileMenu.addEventListener('click', () => {
        mobileMenuBackdrop.classList.add('hidden');
    });

</script>
