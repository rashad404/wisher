@extends('layouts.app')

@section('content')
<div class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-4xl text-center">
      <h2 class="text-base font-semibold leading-7 text-indigo-600">{{ __('Pricing') }}</h2>
      <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{ __('Plans for Your Special Moments') }}</p>
    </div>
    <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600">{{ __('Choose a plan that helps you stay connected, celebrate milestones, and make every occasion memorable.') }}</p>
    <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
      
      @foreach($plans as $plan)
      <div class="rounded-3xl p-8 ring-1 ring-gray-200 xl:p-10">
        <div class="flex items-center justify-between gap-x-4">
          <h3 id="tier-{{ strtolower($plan->name) }}" class="text-lg font-semibold leading-8 text-gray-900">{{ $plan->getTranslation('name', app()->getLocale()) }}</h3>
        </div>
        <p class="mt-6 flex items-baseline gap-x-1">
          <span class="text-4xl font-bold tracking-tight text-gray-900">
            @if($plan->price_monthly)
              ${{ number_format($plan->price_monthly, 2) }}
            @else
              {{ __('Custom') }}
            @endif
          </span>
          <span class="text-sm font-semibold leading-6 text-gray-600">
            @if($plan->price_monthly)
              /{{ __('month') }}
            @endif
          </span>
        </p>
        <a href="#" aria-describedby="tier-{{ strtolower($plan->name) }}" class="mt-6 block rounded-md px-3 py-2 text-center text-sm font-semibold leading-6 text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Buy plan') }}</a>
        <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600 xl:mt-10">
          @foreach($plan->features as $feature)
          <li class="flex gap-x-3">
            <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
            </svg>
            {{ $feature->getTranslation('feature_key', app()->getLocale()) }}
          </li>
          @endforeach
        </ul>
      </div>
      @endforeach

    </div>
  </div>
</div>
@endsection
