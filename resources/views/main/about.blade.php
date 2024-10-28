@extends('layouts.app')

@section('content')

<div class="relative bg-gray-50 py-20 overflow-hidden">
    <!-- Background Patterns -->
    <svg class="absolute inset-x-0 top-0 -z-10 h-[64rem] w-full stroke-gray-200 opacity-30" aria-hidden="true">
        <defs>
            <pattern id="pattern-bg" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                <path d="M.5 200V.5H200" fill="none" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#pattern-bg)" />
    </svg>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <div class="mb-10">
            <x-breadcrumbs :links="[
                ['url' => route('main.index'), 'label' => __('messages.home')],
                ['url' => route('main.about'), 'label' => __('messages.about_us')],
            ]"/>
        </div>

        <!-- Content Section with Increased Spacing -->
        <div class="lg:flex items-start lg:space-x-32"> <!-- Increased space between columns -->
            <!-- Text Content Section -->
            <div class="lg:w-5/12"> <!-- Slightly reduced width to create more space -->
                <div class="border-l-4 border-[#E9654B] pl-4 mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 leading-tight">{{ __('messages.wisher_intro_title') }}</h1>
                </div>

                <div class="space-y-12">
                    <p class="text-lg leading-8 text-gray-600">
                        {{ __('messages.wisher_intro_description') }}
                        <span class="font-semibold text-[#E9654B]">Wisher.az</span> is built on <span class="font-semibold text-[#E9654B]">PHP/Laravel</span>, utilizing
                        <span class="font-semibold text-[#E9654B]">TailwindCSS/Laravel Blade</span>, <span class="font-semibold text-[#E9654B]">MySQL</span>, and a dedicated
                        <span class="font-semibold text-[#E9654B]">Linux server</span>, ensuring fast and reliable service.
                    </p>

                    <div class="border-l-4 border-gray-200 pl-4">
                        <h2 class="text-2xl font-semibold text-gray-900">{{ __('messages.personalized_wishes_title') }}</h2>
                        <p class="mt-4 text-lg text-gray-600">{{ __('messages.personalized_wishes_description') }}</p>
                    </div>

                    <div class="border-l-4 border-gray-200 pl-4">
                        <h2 class="text-2xl font-semibold text-gray-900">{{ __('messages.technology_powered_title') }}</h2>
                        <p class="mt-4 text-lg text-gray-600">{{ __('messages.technology_powered_description') }}</p>
                        <p class="mt-6 text-lg text-gray-600">{{ __('messages.wisher_conclusion') }}</p>
                    </div>
                </div>
            </div>

            <!-- Image Gallery Section -->
            <div class="lg:w-6/12 relative mt-16 lg:mt-0"> <!-- Increased width and top margin -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Top Row Images -->
                    <div class="col-span-1">
                        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&h=500&q=80"
                             alt="Team Working"
                             class="rounded-lg shadow-lg object-cover w-full h-[300px]">
                    </div>
                    <div class="col-span-1">
                        <img src="https://images.unsplash.com/photo-1485217988980-11786ced9454?ixlib=rb-4.0.3&auto=format&fit=crop&h=500&q=80"
                             alt="Office Environment"
                             class="rounded-lg shadow-lg object-cover w-full h-[300px]">
                    </div>

                    <!-- Middle Full-Width Image -->
                    <div class="col-span-2 mt-4">
                        <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                             alt="Café Setting"
                             class="rounded-lg shadow-lg object-cover w-full h-[400px]">
                    </div>

                    <!-- Bottom Row Images -->
                    <div class="col-span-1 mt-4">
                        <img src="https://images.unsplash.com/photo-1670272504528-790c24957dda?ixlib=rb-4.0.3&auto=format&fit=crop&h=500&q=80"
                             alt="Happy Person with Tablet"
                             class="rounded-lg shadow-lg object-cover w-full h-[300px]">
                    </div>
                    <div class="col-span-1 mt-4">
                        <img src="https://images.unsplash.com/photo-1670272505284-8faba1c31f7d?ixlib=rb-4.0.3&auto=format&fit=crop&h=500&q=80"
                             alt="Team Collaboration"
                             class="rounded-lg shadow-lg object-cover w-full h-[300px]">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
