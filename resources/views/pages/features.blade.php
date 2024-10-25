@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ __('messages.key_features') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('messages.discover_standout_features') }}</p>
        </div>

        <!-- Feature Cards -->
        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-2">
            @foreach($features as $feature)
            <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition-shadow duration-200 text-center">
                <!-- Condensed icon mapping with fallback -->
                @php
                    // Array of supported icons, with 'sparkles' as fallback
                    $icons = ['gift', 'heart', 'user-group', 'truck', 'credit-card', 'globe-alt', 'sparkles'];
                    // Check if feature icon exists in array; otherwise, use 'sparkles'
                    $iconName = in_array($feature->icon, $icons) ? $feature->icon : 'sparkles';
                @endphp

                <x-dynamic-component :component="'heroicon-o-' . $iconName" class="mx-auto text-[#E9654B] w-12 h-12" />

                <h3 class="mt-6 text-xl font-semibold text-gray-900">{{ $feature->getTranslation('title', app()->getLocale()) }}</h3>
                <p class="mt-4 text-base text-gray-600">{{ $feature->getTranslation('text', app()->getLocale()) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
