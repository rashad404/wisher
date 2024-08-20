@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.key_features') }}</h2>
        <p class="text-center mt-4 mb-16 text-lg text-gray-600">{{ __('messages.discover_standout_features') }}</p>

        <!-- Group features in pairs -->
        @foreach($features->chunk(2) as $featurePair)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 mb-8">
            @foreach($featurePair as $feature)
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 6.75L15.75 12 9.75 17.25" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $feature->getTranslation('title', app()->getLocale()) }}</h2>
                <p class="text-gray-600">{{ $feature->getTranslation('text', app()->getLocale()) }}</p>
            </div>
            @endforeach
        </div>
        @endforeach

    </div>
</div>
@endsection
