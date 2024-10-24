<div id="mobile-sidebar" class="lg:hidden fixed inset-0 z-50" role="dialog" aria-modal="true">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-gray-900/80"></div>

    <!-- Sidebar -->
    <div class="fixed inset-0 flex">
        <div class="relative flex w-full max-w-xs flex-1">
            <!-- Close Button -->
            <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                <button id="closeSidebarButton" type="button" class="-m-2.5 p-2.5">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar Content -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4 shadow-md">
                <!-- Logo -->
                <div class="flex h-16 items-center justify-center bg-white shadow-sm">
                    <img class="h-10 w-auto" src="{{ asset('images/logo-w.svg') }}" alt="Wisher.az">
                </div>

                <!-- Navigation Links -->
                <nav class="flex flex-1 flex-col mt-4">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <!-- Dashboard link -->
                                <li>
                                    <a href="/user/dashboard" class="{{ request()->is('user/dashboard*') ? 'bg-[#E9654B] text-white shadow-lg' : 'text-gray-600 hover:bg-[#E9654B] hover:text-white hover:shadow-md transition duration-300' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->is('user/dashboard*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                        Əsas səhifə
                                    </a>
                                </li>

                                <!-- Contacts link -->
                                <li>
                                    <a href="/user/contacts" class="{{ request()->is('user/contacts*') ? 'bg-[#E9654B] text-white shadow-lg' : 'text-gray-600 hover:bg-[#E9654B] hover:text-white hover:shadow-md transition duration-300' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->is('user/contacts*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                        Əlaqələrim
                                    </a>
                                </li>

                                <!-- Groups link -->
                                <li>
                                    <a href="/user/groups" class="{{ request()->is('user/groups*') ? 'bg-[#E9654B] text-white shadow-lg' : 'text-gray-600 hover:bg-[#E9654B] hover:text-white hover:shadow-md transition duration-300' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->is('user/groups*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                        </svg>
                                        Qruplarım
                                    </a>
                                </li>

                                <!-- Chat link -->
                                <li>
                                    <a href="/user/chat" class="{{ request()->is('user/chat*') ? 'bg-[#E9654B] text-white shadow-lg' : 'text-gray-600 hover:bg-[#E9654B] hover:text-white hover:shadow-md transition duration-300' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->is('user/chat*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                        </svg>
                                        Mesajlarım
                                    </a>
                                </li>

                                <!-- Events link -->
                                <li>
                                    <a href="/user/events" class="{{ request()->is('user/events*') ? 'bg-[#E9654B] text-white shadow-lg' : 'text-gray-600 hover:bg-[#E9654B] hover:text-white hover:shadow-md transition duration-300' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->is('user/events*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5.25v13.5c0 1.242 1.008 2.25 2.25 2.25h13.5c1.242 0 2.25-1.008 2.25-2.25V5.25M21 5.25H3m3-2.25h12M9 9.75h6M9 13.5h6M9 17.25h6" />
                                        </svg>
                                        Events
                                    </a>
                                </li>

                                <!-- Calendar link -->
                                <li>
                                    <a href="/user/calendar" class="{{ request()->is('user/calendar*') ? 'bg-[#E9654B] text-white shadow-lg' : 'text-gray-600 hover:bg-[#E9654B] hover:text-white hover:shadow-md transition duration-300' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->is('user/calendar*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        Calendar
                                    </a>
                                </li>

                                <!-- Wish Photos link -->
                                <li>
                                    <a href="/user/wish-photos" class="{{ request()->is('user/wish-photos*') ? 'bg-[#E9654B] text-white shadow-lg' : 'text-gray-600 hover:bg-[#E9654B] hover:text-white hover:shadow-md transition duration-300' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->is('user/wish-photos*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5.25v13.5c0 1.242 1.008 2.25 2.25 2.25h13.5c1.242 0 2.25-1.008 2.25-2.25V5.25M21 5.25H3m3-2.25h12M9 9.75h6M9 13.5h6M9 17.25h6" />
                                        </svg>
                                        Wish Photos
                                    </a>
                                </li>

                                <!-- My Orders link -->
                                <li>
                                    <a href="/user/my-orders" class="{{ request()->is('user/my-orders*') ? 'bg-[#E9654B] text-white shadow-lg' : 'text-gray-600 hover:bg-[#E9654B] hover:text-white hover:shadow-md transition duration-300' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->is('user/my-orders*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8V4m0 0C8.686 4 6 6.686 6 10s2.686 6 6 6 6-2.686 6-6-2.686-6-6-6zm-4 10h8m-4 2v1m-4-1c0-1.104-.896-2-2-2m12 2c0-1.104.896-2 2-2M5.207 19.293A1 1 0 014 18.586V17a1 1 0 011-1h14a1 1 0 011 1v1.586a1 1 0 01-.207.707l-1.793 1.793A1 1 0 0117.414 21H6.586a1 1 0 01-.707-.293L5.207 19.293z"/>
                                        </svg>
                                        My Orders
                                    </a>
                                </li>

                                <!-- Send Wish link -->
                                <li>
                                    <a href="/user/send-wish" class="{{ request()->is('user/send-wish*') ? 'bg-[#E9654B] text-white shadow-lg' : 'text-gray-600 hover:bg-[#E9654B] hover:text-white hover:shadow-md transition duration-300' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0 {{ request()->is('user/send-wish*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l9 6 9-6" />
                                        </svg>
                                        Send Wish
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Extra Section -->
                        <li>
                            <div class="text-xs font-semibold leading-6 text-gray-400">Extra</div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                <li>
                                    <a href="#" class="text-gray-600 hover:bg-[#E9654B] hover:text-white group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-gray-300 bg-gray-200 text-[0.625rem] font-medium text-gray-800">H</span>
                                        <span class="truncate">Test</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Settings -->
                        <li class="mt-auto">
                            <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-600 hover:bg-[#E9654B] hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Settings
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
  // Close sidebar when clicking the close button
  document.getElementById('closeSidebarButton').addEventListener('click', function() {
      document.getElementById('mobile-sidebar').classList.add('hidden');
  });
</script>
