@extends('layouts.app')

@section('content')

<!-- Redesigned Testimonials Section -->
<div class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Section Heading -->
        <div class="text-center">
            <h2 class="text-4xl font-bold text-gray-900 tracking-tight">{{ __('messages.what_our_users_say') }}</h2>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">{{ __('messages.user_testimonials_description') }}</p>
        </div>

        <!-- Testimonials Grid -->
        <div class="mt-16 grid grid-cols-1 gap-16 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials as $testimonial)
            <div class="bg-white rounded-lg shadow-lg p-8 transition duration-300 hover:shadow-2xl hover:scale-105 transform group relative">
                <!-- Background Decorative Accent (Optional) -->
                <div class="absolute inset-0 rounded-lg bg-gray-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <!-- User Image -->
                <div class="flex justify-center mb-6 relative z-10">
                    <img class="h-24 w-24 rounded-full border-4 border-gray-300 object-cover"
                         src="{{ Storage::url($testimonial->image) }}"
                         alt="{{ $testimonial->name }}">
                </div>

                <!-- User Info -->
                <div class="text-center relative z-10">
                    <h3 class="text-xl font-semibold text-gray-900 group-hover:text-gray-800">{{ $testimonial->name }}</h3>
                    <p class="mt-2 text-sm font-medium text-gray-500">{{ $testimonial->role ?? __('User') }}</p>
                </div>

                <!-- Testimonial Message -->
                <p class="mt-6 text-gray-700 text-center leading-relaxed relative z-10">
                    “{{ $testimonial->getTranslation('message', app()->getLocale()) }}”
                </p>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
