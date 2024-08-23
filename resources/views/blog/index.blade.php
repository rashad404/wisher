@extends('layouts.app')

@section('content')

<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('messages.home')],
        ['url' => route('blog.index'), 'label' => __('messages.blog')],
    ]"/>
</div>


<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.from_the_blog') }}</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">{{ __('messages.blog_subtitle') }}</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @foreach($blogs as $blog)
            <article class="flex flex-col items-start justify-between">
                <div class="relative w-full">
                    <img src="{{ $blog->image }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                    <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                </div>
                <div class="max-w-xl">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="{{ $blog->published_at->format('Y-m-d') }}" class="text-gray-500">{{ $blog->published_at->format('M d, Y') }}</time>
                        <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ __('messages.blog') }}</a>
                    </div>
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <a href="{{ route('blog.show', ['id' => $blog->id, 'title' => Str::slug($blog->trans('title'))]) }}">
                                <span class="absolute inset-0"></span>
                                {{ $blog->trans('title') }}
                            </a>
                            </a>
                        </h3>
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ Str::limit(strip_tags($blog->getTranslation('content', app()->getLocale())), 150) }}</p>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>
@endsection
