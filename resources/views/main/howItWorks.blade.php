@extends('layouts.app')

@section('content')

    <div class="mx-auto max-w-7xl px-6 lg:px-8 mt-16">
      <div class="my-8">
        <x-breadcrumbs :links="[
          ['url' => route('main.index'), 'label' => __('messages.home')],
          ['url' => route('main.about'), 'label' => __('messages.how_it_works')],
      ]"/>
      </div>
      <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.how_it_works') }}</h2>
        <h6 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-2xl mt-8">{{ __('messages.sign_up') }}</h6>

        <div class="mt-2 flex flex-col gap-x-8 gap-y-20 lg:flex-row">
          <div class="lg:w-full lg:max-w-2xl lg:flex-auto">
            <p class="mt-6 text-xl leading-8 text-gray-600">{{ __('messages.sign_up_description') }}</p>
            <div class="mt-6 max-w-xl text-base leading-7 text-gray-700">

              <h6 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-2xl mt-6">{{ __('messages.add_events') }}</h6>
              <p class="mt-6 text-xl leading-8 text-gray-600">{{ __('messages.add_events_description') }}</p>

              <h6 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-2xl mt-6">{{ __('messages.choose_wish_gift') }}</h6>
              <p class="mt-6 text-xl leading-8 text-gray-600">{{ __('messages.choose_wish_gift_description') }}</p>

              <h6 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-2xl mt-6">{{ __('messages.set_delivery') }}</h6>
              <p class="mt-6 text-xl leading-8 text-gray-600">{{ __('messages.set_delivery_description') }}</p>
            </div>
          </div>
          <div class="lg:flex lg:flex-auto lg:justify-center">
            <dl class="w-64 space-y-8 xl:w-80">
              <div class="flex flex-col-reverse gap-y-4">
                <dt class="text-base leading-7 text-gray-600">{{ __('messages.greetings_sent') }}</dt>
                <dd class="text-5xl font-semibold tracking-tight text-gray-900">100,000+</dd>
              </div>
              <div class="flex flex-col-reverse gap-y-4">
                <dt class="text-base leading-7 text-gray-600">{{ __('messages.gifts_sent') }}</dt>
                <dd class="text-5xl font-semibold tracking-tight text-gray-900">5,000+</dd>
              </div>
              <div class="flex flex-col-reverse gap-y-4">
                <dt class="text-base leading-7 text-gray-600">{{ __('messages.users_joined') }}</dt>
                <dd class="text-5xl font-semibold tracking-tight text-gray-900">50,000+</dd>
              </div>
            </dl>
          </div>
        </div>
      </div>
    </div>

    <!-- Image section -->
    <div class="mt-32 sm:mt-40 xl:mx-auto xl:max-w-7xl xl:px-8 mb-20">
      <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2832&q=80" alt="" class="aspect-[5/2] w-full object-cover xl:rounded-3xl">
    </div>

@endsection
