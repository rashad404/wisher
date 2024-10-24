@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 bg-white pb-8 sm:pb-16 md:pb-20 lg:w-full lg:pb-28 xl:pb-32">
            <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                <!-- Navigation (if needed) -->
            </div>

            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                    <!-- Hero Content -->
                    <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">{{ __('messages.main_heading') }}</span>
                        </h1>
                        <p class="mt-6 text-lg text-gray-600">{{ __('messages.main_description_1') }}</p>
                        <p class="mt-4 text-lg text-gray-600">{{ __('messages.main_description_2') }}</p>
                        <div class="mt-8 flex justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="/register" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#E9654B] hover:bg-[#d45a43] md:py-4 md:text-lg md:px-10">
                                    {{ __('messages.register_now') }}
                                </a>
                            </div>
                            <div class="ml-3">
                                <a href="/how-it-works" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-[#E9654B] bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                    {{ __('messages.learn_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Hero Image -->
                    <div class="mt-12 lg:mt-0 lg:col-span-6">
                        <img class="mx-auto lg:mx-0 lg:max-w-md max-w-full h-auto object-cover" src="{{ asset('images/hero-image2.jpg') }}" alt="Hero Image">
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>


<!-- Create Wish Photo Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ __('messages.create_wish_photo_title') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('messages.create_wish_photo_description') }}</p>
            <div class="mt-8">
                <a href="{{ route('wish-photos') }}" class="inline-block px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#E9654B] hover:bg-[#d45a43]">
                    {{ __('messages.create_your_wish_photo') }}
                </a>
            </div>
        </div>
        <!-- Image Grid -->
        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <div class="overflow-hidden rounded-lg shadow-lg">
                <img class="w-full h-56 object-cover" src="{{ asset('images/birthday.jpg') }}" alt="Birthday Wish Photo">
            </div>
            <div class="overflow-hidden rounded-lg shadow-lg">
                <img class="w-full h-56 object-cover" src="{{ asset('images/christmas.jpg') }}" alt="Christmas Wish Photo">
            </div>
            <div class="overflow-hidden rounded-lg shadow-lg">
                <img class="w-full h-56 object-cover" src="{{ asset('images/halloween.jpg') }}" alt="Halloween Wish Photo">
            </div>
        </div>
    </div>
</div>

<!-- Key Features Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ __('messages.key_features') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('messages.discover_standout_features') }}</p>
        </div>
        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($features as $feature)
            <div class="text-center">
                <!-- Use real icon names for each feature -->
                <i class="fas fa-key mx-auto text-[#E9654B]" style="font-size: 3rem;"></i>

                <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ $feature->trans('title') }}</h3>
                <p class="mt-4 text-base text-gray-600">{{ $feature->trans('text') }}</p>
            </div>
            @endforeach
        </div>
        <div class="mt-10 text-center">
            <a href="/features" class="text-[#E9654B] font-semibold hover:underline">{{ __('messages.explore_all_features') }} &rarr;</a>
        </div>
    </div>
</div>


<!-- How It Works Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ __('messages.how_it_works_title') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('messages.how_it_works_description') }}</p>
        </div>
        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Step 1 -->
            <div class="text-center">
                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-[#E9654B] text-white mx-auto">
                    <span class="text-xl font-bold">1</span>
                </div>
                <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ __('messages.how_it_works_step1_title') }}</h3>
                <p class="mt-4 text-base text-gray-600">{{ __('messages.how_it_works_step1_description') }}</p>
            </div>
            <!-- Step 2 -->
            <div class="text-center">
                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-[#E9654B] text-white mx-auto">
                    <span class="text-xl font-bold">2</span>
                </div>
                <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ __('messages.how_it_works_step2_title') }}</h3>
                <p class="mt-4 text-base text-gray-600">{{ __('messages.how_it_works_step2_description') }}</p>
            </div>
            <!-- Step 3 -->
            <div class="text-center">
                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-[#E9654B] text-white mx-auto">
                    <span class="text-xl font-bold">3</span>
                </div>
                <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ __('messages.how_it_works_step3_title') }}</h3>
                <p class="mt-4 text-base text-gray-600">{{ __('messages.how_it_works_step3_description') }}</p>
            </div>
            <!-- Step 4 -->
            <div class="text-center">
                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-[#E9654B] text-white mx-auto">
                    <span class="text-xl font-bold">4</span>
                </div>
                <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ __('messages.how_it_works_step4_title') }}</h3>
                <p class="mt-4 text-base text-gray-600">{{ __('messages.how_it_works_step4_description') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Gifts Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ __('messages.giftsTitle') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('messages.giftsSubTitle') }}</p>
        </div>
        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
            <x-product-card :product="$product" />
            @endforeach
        </div>
        <div class="mt-10 text-center">
            <a href="/products" class="text-[#E9654B] font-semibold hover:underline">{{ __('messages.viewAllGifts') }} &rarr;</a>
        </div>
    </div>
</div>

<!-- Blog Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ __('messages.from_the_blog') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('messages.blog_subtitle') }}</p>
        </div>
        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($blogs as $blog)
            <div class="border rounded-lg shadow-sm overflow-hidden flex flex-col h-full hover:shadow-lg hover:-translate-y-2 transform transition-all duration-300">
                <div class="flex-shrink-0">
                    <img class="h-48 w-full object-cover" src="{{ Storage::url($blog->image ?? 'default_images/blog.jpg') }}" alt="{{ $blog->title }}">
                </div>
                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <a href="{{ route('blog.show', ['id' => $blog->id, 'title' => Str::slug($blog->title)]) }}">{{ $blog->title }}</a>
                    </h3>
                    <p class="mt-3 text-base text-gray-600">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                    <div class="mt-6">
                        <a href="{{ route('blog.show', ['id' => $blog->id, 'title' => Str::slug($blog->title)]) }}" class="text-[#E9654B] font-semibold hover:underline">{{ __('messages.read_more') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-10 text-center">
            <a href="/blog" class="text-[#E9654B] font-semibold hover:underline">{{ __('messages.view_all_posts') }} &rarr;</a>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ __('messages.what_our_users_say') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('messages.user_testimonials_description') }}</p>
        </div>
        <div class="mt-12 space-y-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-gray-50 rounded-lg p-6 shadow">
                <div class="flex items-center space-x-4">
                    <img class="h-12 w-12 rounded-full" src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->name }}">
                    <div>
                        <p class="text-lg font-semibold text-gray-900">{{ $testimonial->name }}</p>
                        <p class="text-sm text-gray-600">{{ $testimonial->role ?? __('User') }}</p>
                    </div>
                </div>
                <p class="mt-4 text-base text-gray-700">"{{ $testimonial->getTranslation('message', app()->getLocale()) }}"</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Pricing Section (Continued) -->
<div class="bg-gray-50 py-16">
<div class="max-w-7xl mx-auto px-6 lg:px-8">
<div class="text-center">
    <h2 class="text-3xl font-extrabold text-gray-900">{{ __('messages.choose_your_plan') }}</h2>
    <p class="mt-4 text-lg text-gray-600">{{ __('messages.plan_description') }}</p>
</div>

<div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
    @foreach($plans as $plan)
    <div class="border rounded-lg shadow-sm overflow-hidden flex flex-col h-full hover:shadow-lg hover:-translate-y-2 transform transition-all duration-300">
        <!-- Plan Header (Name and Description) -->
        <div class="px-6 py-8 bg-white">
            <h3 class="text-xl font-semibold text-gray-900">{{ $plan->getTranslation('name', app()->getLocale()) }}</h3>
            <p class="mt-4 text-gray-600 min-h-[50px]">
                {{ $plan->description ?? __('messages.plan_default_description') }}
            </p>
        </div>
        <!-- Pricing Info -->
        <div class="px-6 py-4 bg-gray-50 flex justify-center items-center min-h-[100px]">
            <div class="text-center">
                <span class="text-4xl font-extrabold text-gray-900">${{ number_format($plan->price_monthly, 2) }}</span>
                <span class="text-base font-medium text-gray-600">/{{ __('messages.month') }}</span>
            </div>
        </div>
        <!-- Plan Features -->
        <div class="px-6 py-6 bg-white flex-grow">
            <ul class="space-y-4">
                @foreach($plan->features as $feature)
                <li class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-[#E9654B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="ml-3 text-base text-gray-700">{{ $feature->getTranslation('feature_key', app()->getLocale()) }}</p>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- Sign Up Button -->
        <div class="px-6 py-6 bg-gray-50 text-center">
            <a href="/pricing" class="block w-full text-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#E9654B] hover:bg-[#d45a43] transition-colors duration-300">
                {{ __('messages.sign_up') }}
            </a>
        </div>
    </div>
    @endforeach
</div>
<div class="mt-10 text-center">
    <a href="/pricing" class="text-[#E9654B] font-semibold hover:underline">{{ __('messages.view_all_plans') }} &rarr;</a>
</div>
</div>
</div>

<!-- Redesigned Call to Action Section -->
<div class="py-16 bg-white relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
            {{ __('messages.get_started_with_wisher_today') }}
        </h2>
        <p class="mt-4 text-lg text-gray-600">
            {{ __('messages.make_every_occasion_unforgettable') }}
        </p>
        <div class="mt-8">
            <a href="/register"
               class="inline-block px-8 py-3 border-2 border-[#E9654B] text-[#E9654B] font-semibold text-lg rounded-md hover:bg-[#E9654B] hover:text-white transition-colors duration-300 shadow-sm">
                {{ __('messages.sign_up_now') }}
            </a>
        </div>
    </div>

    <!-- Decorative Shape (Optional) -->
    <!-- Heroicon: sparkles -->
    <svg class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-12 w-[120px] h-[120px] text-[#E9654B] opacity-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
    </svg>
</div>

@endsection
