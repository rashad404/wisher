@extends('layouts.app')

@section('content')


    <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
      <defs>
        <pattern id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
          <path d="M100 200V.5M.5 .5H200" fill="none" />
        </pattern>
      </defs>
      <svg x="50%" y="-1" class="overflow-visible fill-gray-50">
        <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M-300.5 600h201v201h-201Z" stroke-width="0" />
      </svg>
      <rect width="100%" height="100%" stroke-width="0" fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" />
    </svg>
    <div class="mx-auto max-w-7xl px-6 py-16 sm:py-16 lg:flex lg:items-center lg:gap-x-10 lg:px-8 lg:py-16">
      <div class="mx-auto max-w-2xl lg:mx-0 lg:flex-auto">
        <div class="flex">
          <div class="relative flex items-center gap-x-4 rounded-full px-4 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
            <span class="font-semibold text-indigo-600">Hədiyyələr</span>
            <span class="h-4 w-px bg-gray-900/10" aria-hidden="true"></span>
            <a href="/gifts" class="flex items-center gap-x-1">
              <span class="absolute inset-0" aria-hidden="true"></span>
              Katoloqu göstər
              <svg class="-mr-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        <h1 class="mt-10 max-w-lg text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">{{__('messages.main_heading')}}</h1>

          <p class="mt-6 text-xl leading-8 text-gray-700">{{__('messages.main_description_1')}}</p>
          <p class="mt-6 text-xl leading-8 text-gray-700">{{__('messages.main_description_2')}}</p>
          <p class="mt-6 text-xl leading-8 text-gray-700">{{__('messages.main_description_3')}}</p>
          <p class="mt-6 text-xl leading-8 text-gray-700">{{__('messages.main_description_4')}}</p>
          <p class="mt-6 text-xl leading-8 text-gray-700">{{__('messages.main_description_5')}}</p>
          <p class="mt-6 text-xl leading-8 text-gray-700">{{__('messages.main_description_6')}}</p>

        <div class="mt-10 flex items-center gap-x-6">
          <a href="/register" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{__('messages.register_now')}}</a>
          <a href="/how-it-works" class="text-sm font-semibold leading-6 text-gray-900">{{__('messages.learn_more')}} <span aria-hidden="true">→</span></a>
        </div>
      </div>
      <div class="mt-16 sm:mt-24 lg:mt-0 lg:flex-shrink-0 lg:flex-grow">
        <svg viewBox="0 0 366 729" role="img" class="mx-auto w-[22.875rem] max-w-full drop-shadow-xl">
          <title>App screenshot</title>
          <defs>
            <clipPath id="2ade4387-9c63-4fc4-b754-10e687a0d332">
              <rect width="316" height="684" rx="36" />
            </clipPath>
          </defs>
          <path fill="#4B5563" d="M363.315 64.213C363.315 22.99 341.312 1 300.092 1H66.751C25.53 1 3.528 22.99 3.528 64.213v44.68l-.857.143A2 2 0 0 0 1 111.009v24.611a2 2 0 0 0 1.671 1.973l.95.158a2.26 2.26 0 0 1-.093.236v26.173c.212.1.398.296.541.643l-1.398.233A2 2 0 0 0 1 167.009v47.611a2 2 0 0 0 1.671 1.973l1.368.228c-.139.319-.314.533-.511.653v16.637c.221.104.414.313.56.689l-1.417.236A2 2 0 0 0 1 237.009v47.611a2 2 0 0 0 1.671 1.973l1.347.225c-.135.294-.302.493-.49.607v377.681c0 41.213 22 63.208 63.223 63.208h95.074c.947-.504 2.717-.843 4.745-.843l.141.001h.194l.086-.001 33.704.005c1.849.043 3.442.37 4.323.838h95.074c41.222 0 63.223-21.999 63.223-63.212v-394.63c-.259-.275-.48-.796-.63-1.47l-.011-.133 1.655-.276A2 2 0 0 0 366 266.62v-77.611a2 2 0 0 0-1.671-1.973l-1.712-.285c.148-.839.396-1.491.698-1.811V64.213Z" />
          <path fill="#343E4E" d="M16 59c0-23.748 19.252-43 43-43h246c23.748 0 43 19.252 43 43v615c0 23.196-18.804 42-42 42H58c-23.196 0-42-18.804-42-42V59Z" />
          <foreignObject width="316" height="100%" transform="translate(24 24)" clip-path="url(#2ade4387-9c63-4fc4-b754-10e687a0d332)">
            <img style="height: 100% !important" src="{{ asset('images/wish-banner.jpg') }}" alt="" />
          </foreignObject>
        </svg>
      </div>
    </div>


    {{-- Key Features --}}
    <div class="bg-gray-50 py-16">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="max-w-2xl mx-auto text-center">
              <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.key_features') }}</h2>
              <p class="mt-4 text-lg text-gray-600">{{ __('messages.discover_standout_features') }}</p>
          </div>
          <div class="mt-10 grid grid-cols-1 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 lg:gap-x-8">
              @foreach($features as $feature)
              <div class="text-center">
                  <img class="mx-auto h-12 w-12" src="{{ Storage::url($feature->image) }}" alt="{{ $feature->trans('title')}} Icon">
                  <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ $feature->trans('title')}}</h3>
                  <p class="mt-4 text-sm text-gray-600">{{ $feature->trans('text')}}</p>
              </div>
              @endforeach
          </div>
          <div class="mt-10 text-center">
              <a href="/features" class="text-indigo-600 font-semibold">{{ __('messages.explore_all_features') }} &rarr;</a>
          </div>
      </div>
    </div>



    {{-- How it works --}}
    <div class="bg-white py-16">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="max-w-2xl mx-auto text-center">
              <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.how_it_works_title') }}</h2>
              <p class="mt-4 text-lg text-gray-600">{{ __('messages.how_it_works_description') }}</p>
          </div>
          <div class="mt-10 grid grid-cols-1 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 lg:gap-x-8">
              <div class="text-center">
                  <img class="mx-auto h-12 w-12" src="{{Storage::url("default_images/how.jpg")}}" alt="{{ __('messages.how_it_works_step1_title') }} Icon">
                  <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ __('messages.how_it_works_step1_title') }}</h3>
                  <p class="mt-4 text-sm text-gray-600">{{ __('messages.how_it_works_step1_description') }}</p>
              </div>
              <div class="text-center">
                  <img class="mx-auto h-12 w-12" src="{{Storage::url("default_images/how.jpg")}}" alt="{{ __('messages.how_it_works_step2_title') }} Icon">
                  <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ __('messages.how_it_works_step2_title') }}</h3>
                  <p class="mt-4 text-sm text-gray-600">{{ __('messages.how_it_works_step2_description') }}</p>
              </div>
              <div class="text-center">
                  <img class="mx-auto h-12 w-12" src="{{Storage::url("default_images/how.jpg")}}" alt="{{ __('messages.how_it_works_step3_title') }} Icon">
                  <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ __('messages.how_it_works_step3_title') }}</h3>
                  <p class="mt-4 text-sm text-gray-600">{{ __('messages.how_it_works_step3_description') }}</p>
              </div>
              <div class="text-center">
                  <img class="mx-auto h-12 w-12" src="{{Storage::url("default_images/how.jpg")}}" alt="{{ __('messages.how_it_works_step4_title') }} Icon">
                  <h3 class="mt-6 text-lg font-semibold text-gray-900">{{ __('messages.how_it_works_step4_title') }}</h3>
                  <p class="mt-4 text-sm text-gray-600">{{ __('messages.how_it_works_step4_description') }}</p>
              </div>
          </div>
      </div>
    </div>

    {{-- Gift --}}
    <div class="bg-gray-50 py-16">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
          <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.giftsTitle') }}</h2>
          <p class="mt-2 text-lg leading-8 text-gray-600">{{ __('messages.giftsSubTitle') }}</p>
        </div>
        <div class="mt-10 grid grid-cols-1 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8">
          
          @foreach ($products as $product)
            <x-product-card :product="$product" />
          @endforeach
        </div>
        <div class="mt-10 text-center">
          <a href="/products" class="text-indigo-600 font-semibold">{{ __('messages.viewAllGifts') }} &rarr;</a>
        </div>
      </div>
    </div>
    
    {{-- Blog --}}
    <div class="bg-gray-50 py-16">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
          <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.from_the_blog') }}</h2>
          <p class="mt-2 text-lg leading-8 text-gray-600">{{ __('messages.blog_subtitle') }}</p>
        </div>
        <div class="mt-10 grid grid-cols-1 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8">
          <!-- Example Blog Post -->
          @foreach($blogs as $blog)
            <article>
              <div class="aspect-w-4 aspect-h-3">
                <img class="object-cover shadow-lg rounded-lg" src="{{ Storage::url($blog->image ?? "default_images/blog.jpg") }}" alt="{{ $blog->title }}">
              </div>
              <div class="mt-4">
                <h3 class="text-lg font-semibold text-gray-900">
                  <a href="{{ route('blog.show', ['id' => $blog->id, 'title' => Str::slug($blog->title)]) }}">{{ $blog->title }}</a>
                </h3>
                </h3>
                <p class="mt-2 text-sm text-gray-600">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
              </div>
            </article>
          @endforeach
        </div>
        <div class="mt-10 text-center">
          <a href="/blog" class="text-indigo-600 font-semibold">{{ __('View All Posts') }} &rarr;</a>
        </div>
      </div>
    </div>

    {{-- Testimonials --}}

    <div class="bg-white py-16">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.what_our_users_say') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('messages.user_testimonials_description') }}</p>        
          </div>
          <div class="mt-10 space-y-8">
              @foreach($testimonials as $testimonial)
                  <blockquote class="rounded-lg bg-gray-100 p-8">
                      <div class="flex items-center gap-x-4">
                          <img class="h-12 w-12 rounded-full" src="{{Storage::url($testimonial->image)}}" alt="{{ $testimonial->name }}">
                          <div>
                              <p class="text-lg font-semibold text-gray-900">{{ $testimonial->name }}</p>
                              <p class="text-sm text-gray-500">{{ $testimonial->role ?? __('User') }}</p>
                          </div>
                      </div>
                      <p class="mt-4 text-base text-gray-700">"{{ $testimonial->getTranslation('message', app()->getLocale()) }}"</p>
                  </blockquote>
              @endforeach
          </div>
      </div>
    </div>


    
    {{-- Pricing --}}
    <div class="bg-gray-50 py-16">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="max-w-2xl mx-auto text-center">
              <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.choose_your_plan') }}</h2>
              <p class="mt-4 text-lg text-gray-600">{{ __('messages.plan_description') }}</p>
          </div>
          <div class="mt-10 grid grid-cols-1 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8">
              @foreach($plans as $plan)
                  <div class="border rounded-lg p-6 shadow-sm bg-white">
                      <h3 class="text-lg font-semibold text-gray-900">{{ $plan->getTranslation('name', app()->getLocale()) }}</h3>
                      <p class="mt-6 text-4xl font-bold text-gray-900">${{ number_format($plan->price_monthly, 2) }}<span class="text-base font-medium text-gray-500">/{{ __('messages.month') }}</span></p>
                      <ul class="mt-6 space-y-2 text-sm text-gray-600">
                          @foreach($plan->features as $feature)
                              <li class="flex items-center">
                                  <svg class="h-5 w-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 4.707 7.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                                  </svg>
                                  <span class="ml-2">{{ $feature->getTranslation('feature_key', app()->getLocale()) }}</span>
                              </li>
                          @endforeach
                      </ul>
                      <a href="/pricing" class="mt-6 block w-full rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white">{{ __('messages.sign_up') }}</a>
                  </div>
              @endforeach
          </div>
          <div class="mt-10 text-center">
              <a href="/pricing" class="text-indigo-600 font-semibold">{{ __('messages.view_all_plans') }} &rarr;</a>
          </div>
      </div>
    </div>


    
    {{-- CTA Section --}}
    <div class="bg-indigo-600 py-16">
      <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
          <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ __('messages.get_started_with_wisher_today') }}</h2>
          <p class="mt-4 text-lg text-indigo-200">{{ __('messages.make_every_occasion_unforgettable') }}</p>
          <div class="mt-8">
              <a href="/register" class="inline-block rounded-md bg-white px-6 py-3 text-base font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50">{{ __('messages.sign_up_now') }}</a>
          </div>
      </div>
  </div>
  
    


@endsection
