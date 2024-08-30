<header class="bg-[#331E6D]">
    <nav class="mx-auto flex max-w-7xl items-center justify-between gap-x-6 p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="/" class="-m-1.5 p-1.5">
                <span class="sr-only">Wisher.az</span>
                <img class="w-32" src="{{ asset('images/logo.svg') }}" alt="Wisher.az">
            </a>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            @php
                

            @endphp
            @foreach ($menus as $menu)
                @if ($menu->children->isEmpty())
                    <!-- Render top-level menu item if no children -->
                    <a href="{{ $menu->url }}" class="text-sm font-semibold leading-6 text-white">{{ $menu->trans("name") }}</a>
                @else
                    <!-- Render menu with submenu -->
                    <div class="relative">
                        <button type="button" class="inline-flex items-center gap-x-1 text-sm font-semibold leading-6 text-white flyout-toggle" aria-expanded="false">

                            <span>{{ $menu->trans("name") }}</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Submenu -->
                        <div class="absolute left-1/2 z-10 mt-5 flex w-screen max-w-max -translate-x-1/2 px-4 flyout-menu hidden">
                            <div class="w-screen max-w-md flex-auto overflow-hidden rounded-3xl bg-white text-sm leading-6 shadow-lg ring-1 ring-gray-900/5">
                              <div class="p-4">
                                @foreach ($menu->children as $submenu)
                                <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                  <div class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                      <!-- Example SVG, replace as needed -->
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                                    </svg>
                                  </div>
                                  <div>
                                    <a href="{{ $submenu->url }}" class="font-semibold text-gray-900">
                                      {{ $submenu->trans("name") }}
                                      <span class="absolute inset-0"></span>
                                    </a>
                                    <p class="mt-1 text-gray-600">{{ $submenu->trans("desc") }}</p>
                                  </div>
                                </div>
                                @endforeach
                              </div>
                              <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
                                <a href="#" class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
                                  <!-- Additional flyout footer links or actions -->
                                  <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm6.39-2.908a.75.75 0 01.766.027l3.5 2.25a.75.75 0 010 1.262l-3.5 2.25A.75.75 0 018 12.25v-4.5a.75.75 0 01.39-.658z" clip-rule="evenodd" />
                                  </svg>
                                  Watch demo
                                </a>
                                <a href="/contact" class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
                                  <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                                  </svg>
                                  Contact sales
                                </a>
                              </div>
                            </div>
                          </div>
                          
                    </div>
                @endif
            @endforeach
        </div>
        <div class="flex flex-1 items-center justify-end gap-x-6">
            <!-- Language Dropdown -->
            <div class="relative z-50">
                <button type="button" class="text-white text-sm font-semibold leading-6 focus:outline-none" id="languageButton">
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" id="languageDropdown">
                    <div class="py-1">
                        <!-- Language options -->
                        @foreach (['en', 'az', 'es', 'fr', 'de', 'pt', 'ru', 'zh-CN', 'ar', 'hi', 'ja', 'it'] as $lang)
                            <a href="{{ route('switchLang', $lang) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ __('messages.' . $lang) }}
                            </a>
                        @endforeach
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
            
            <div class="mt-6 flow-root px-6 py-6">
                <div class="-my-6 divide-y divide-gray-500/10">

                    <div class="pb-6">
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
                    <div class="space-y-2 py-6">
                        @foreach ($menus as $menu)
                            <!-- Main Menu Item -->
                            <div class="relative">
                                <button type="button" class="-mx-3 flex w-full items-center justify-between rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 menu-toggle">
                                    {{ $menu->trans('name') }}
                                    @if ($menu->children->isNotEmpty())
                                        <svg class="h-5 w-5 transition-transform transform menu-arrow" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </button>
                                <!-- Submenus -->
                                @if ($menu->children->isNotEmpty())
                                    <div class="hidden submenu space-y-2 pl-6">
                                        @foreach ($menu->children as $submenu)
                                            <a href="{{ $submenu->url }}" class="block rounded-lg px-3 py-2 text-sm font-medium leading-7 text-gray-700 hover:bg-gray-50">
                                                {{ $submenu->trans('name') }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</header>

<!-- JavaScript for toggling menus -->
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

    @auth
        // Dropdown toggle for user menu
        document.getElementById('userDropdownButton').addEventListener('click', function() {
            var dropdown = document.getElementById('userDropdownMenu');
            dropdown.classList.toggle('hidden');
        });
    @endauth

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('userDropdownMenu');
        var button = document.getElementById('userDropdownButton');
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Flyout menu
    document.querySelectorAll('.flyout-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const menu = this.nextElementSibling;
            menu.classList.toggle('hidden'); // Show/Hide the menu
        });
    });

    // Optional: Close the flyout when clicking outside
    document.addEventListener('click', function(event) {
        document.querySelectorAll('.flyout-menu').forEach(menu => {
            if (!menu.contains(event.target) && !menu.previousElementSibling.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    });

    // Toggle submenu visibility and rotate arrow
    document.querySelectorAll('.menu-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            const arrow = this.querySelector('.menu-arrow');

            if (submenu) {
                submenu.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180'); // Rotate arrow when submenu is opened/closed
            }
        });
    });

</script>
