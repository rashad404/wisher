@extends('layouts.app')

@section('content')
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
@endsection
