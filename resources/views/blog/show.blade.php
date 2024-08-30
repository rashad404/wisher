@extends('layouts.app')

@section('content')

<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Home')],
        ['url' => route('blog.index'), 'label' => __('Blog')],
        ['url' => route('blog.show', ['id' => $blog->id, 'title' => Str::slug($blog->trans('title'))]), 'label' => $blog->trans('title')]
    ]"/>

    <div class="bg-white px-6 py-32 lg:px-8">
        <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">
            <p class="text-base font-semibold leading-7 text-indigo-600">{{ __('Introducing') }}</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $blog->trans('title') }}</h1>
            <p class="mt-6 text-xl leading-8">{{ $blog->published_at->format('M d, Y') }}</p>

            <!-- Blog Image -->
            <div class="mt-8">
                <img src="{{ Storage::url($blog->image ?? 'default_images/blog.jpg') }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
            </div>

            <!-- Blog Content -->
            <div class="mt-10 max-w-2xl">
                {!! $blog->trans('content') !!}
            </div>
        </div>
    </div>
</div>

@endsection
