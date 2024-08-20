@extends('layouts.app')

@section('content')
<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <h2 class="text-base font-semibold leading-7 text-indigo-600">{{ __('Testimonials') }}</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('What People Are Saying') }}</p>
        </div>
        <div class="mt-16 grid gap-16 lg:grid-cols-3">
            @foreach($testimonials as $testimonial)
            <div class="text-center">
                <img class="mx-auto h-24 w-24 rounded-full" src="{{ $testimonial->image }}" alt="{{ $testimonial->name }}">
                <h3 class="mt-6 text-lg font-medium text-gray-900">{{ $testimonial->name }}</h3>
                <p class="mt-2 text-base text-indigo-600">{{ $testimonial->role }}</p>
                <p class="mt-4 text-sm text-gray-600">"{{ $testimonial->getTranslation('message', app()->getLocale()) }}"</p>
            </div>
            @endforeach
            
        </div>
    </div>
</div>
@endsection
