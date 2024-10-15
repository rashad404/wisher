<header class="bg-[#E9654B]" x-data="{ openMobileMenu: false }">
    <nav class="container mx-auto flex items-center justify-between py-4 px-6">
        <!-- Left Side: Logo -->
        <div class="flex items-center space-x-6">
            <a href="/" class="flex items-center">
                <img src="{{ asset('images/logo.svg') }}" alt="Wisher.az" class="w-40">
            </a>
            <!-- Horizontal Divider -->
            <div class="hidden lg:block   mr-96"></div>
            <!-- Centered Menu Links -->
            <div class="hidden lg:flex space-x-8">
                @foreach ($menus as $menu)
                    @if ($menu->children->isEmpty())
                        <a href="{{ $menu->url }}" class="text-white font-semibold hover:text-gray-200 transition duration-300">
                            {{ $menu->trans("name") }}
                        </a>
                    @else
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="text-white font-semibold flex items-center hover:text-gray-200 transition duration-300 focus:outline-none">
                                <span>{{ $menu->trans("name") }}</span>
                                <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transform transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute mt-2 w-48 bg-white rounded-md shadow-lg z-20">
                                @foreach ($menu->children as $submenu)
                                    <a href="{{ $submenu->url }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300">
                                        {{ $submenu->trans("name") }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- Right Side Icons -->
        <div class="flex items-center space-x-4">
            <!-- Language Selector -->
            <div x-data="{ open: false }" class="relative hidden lg:block">
                <button @click="open = !open" class="text-white hover:text-gray-200 focus:outline-none transition duration-300 flex items-center">
                    <i class="fas fa-globe"></i>
                    <span class="ml-1">{{ strtoupper(app()->getLocale()) }}</span>
                </button>
                <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg z-20">
                    @foreach (['en', 'az', 'es', 'fr', 'de', 'pt', 'ru', 'zh-CN', 'ar', 'hi', 'ja', 'it'] as $lang)
                        <a href="{{ route('switchLang', $lang) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300">
                            {{ __('messages.' . $lang) }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Shopping Cart -->
            <a href="{{ route('cart.index') }}" class="text-white relative hover:text-gray-200 transition duration-300">
                <i class="fas fa-shopping-cart text-2xl"></i>
                @if(session('cart_count') > 0)
                    <span class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                        {{ session('cart_count') }}
                    </span>
                @endif
            </a>

            <!-- Authentication Links -->
            @auth
                <!-- User Dropdown -->
                <div x-data="{ open: false }" class="relative hidden lg:block">
                    <button @click="open = !open" class="flex items-center text-white focus:outline-none hover:text-gray-200 transition duration-300">
                        <img src="{{ Storage::url(auth()->user()->profile->profile_photo ?? 'images/user.png') }}" alt="{{ auth()->user()->name() }}" class="w-8 h-8 rounded-full">
                        <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transform transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
                        <a href="{{ route('user.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300">
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300">
                            {{ __('Your Profile') }}
                        </a>
                        <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300">
                            {{ __('Settings') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300">
                                {{ __('Sign out') }}
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="/login" class="hidden lg:block text-white font-semibold hover:text-gray-200 transition duration-300">{{ __('messages.log_in') }}</a>
                <a href="/register" class="hidden lg:block bg-white text-[#E9654B] px-4 py-2 rounded-md font-semibold hover:bg-gray-100 transition duration-300">
                    {{ __('messages.sign_up') }}
                </a>
            @endauth

            <!-- Mobile Menu Button -->
            <button @click="openMobileMenu = !openMobileMenu" class="lg:hidden text-white focus:outline-none hover:text-gray-200 transition duration-300">
                <svg x-show="!openMobileMenu" class="h-6 w-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                </svg>
                <svg x-show="openMobileMenu" x-cloak class="h-6 w-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Navigation Menu -->
    <div x-show="openMobileMenu" @click.away="openMobileMenu = false" x-cloak class="lg:hidden">
        <div class="bg-white shadow-lg">
            <div class="py-4 px-6 space-y-4">
                @foreach ($menus as $menu)
                    @if ($menu->children->isEmpty())
                        <a href="{{ $menu->url }}" class="block text-gray-700 font-semibold hover:bg-gray-100 px-4 py-2 rounded transition duration-300">
                            {{ $menu->trans("name") }}
                        </a>
                    @else
                        <div x-data="{ openSubmenu: false }">
                            <button @click="openSubmenu = !openSubmenu" class="flex justify-between w-full text-gray-700 font-semibold hover:bg-gray-100 px-4 py-2 rounded transition duration-300 focus:outline-none">
                                <span>{{ $menu->trans("name") }}</span>
                                <svg :class="{ 'rotate-180': openSubmenu }" class="h-4 w-4 transform transition-transform duration-300" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="openSubmenu" x-cloak class="mt-2 space-y-2 pl-6">
                                @foreach ($menu->children as $submenu)
                                    <a href="{{ $submenu->url }}" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded transition duration-300">
                                        {{ $submenu->trans("name") }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
                <!-- Language Selector -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center text-gray-700 font-semibold hover:bg-gray-100 px-4 py-2 rounded transition duration-300 focus:outline-none">
                        <i class="fas fa-globe"></i>
                        <span class="ml-2">{{ strtoupper(app()->getLocale()) }}</span>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="mt-2 bg-white rounded-md shadow-lg z-20">
                        @foreach (['en', 'az', 'es', 'fr', 'de', 'pt', 'ru', 'zh-CN', 'ar', 'hi', 'ja', 'it'] as $lang)
                            <a href="{{ route('switchLang', $lang) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300">
                                {{ __('messages.' . $lang) }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- Authentication Links -->
                @auth
                    <div class="border-t border-gray-200 pt-4">
                        <a href="{{ route('user.index') }}" class="block text-gray-700 font-semibold hover:bg-gray-100 px-4 py-2 rounded transition duration-300">
                            {{ __('Dashboard') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left text-gray-700 font-semibold hover:bg-gray-100 px-4 py-2 rounded transition duration-300">
                                {{ __('Sign out') }}
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-gray-200 pt-4">
                        <a href="/login" class="block text-gray-700 font-semibold hover:bg-gray-100 px-4 py-2 rounded transition duration-300">{{ __('messages.log_in') }}</a>
                        <a href="/register" class="block bg-[#E9654B] text-white font-semibold hover:bg-[#d45a43] px-4 py-2 rounded transition duration-300">
                            {{ __('messages.sign_up') }}
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
