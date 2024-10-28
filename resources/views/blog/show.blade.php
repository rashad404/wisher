@extends('layouts.app')

@section('content')

<!-- Breadcrumb Section -->
<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Home')],
        ['url' => route('blog.index'), 'label' => __('Blog')],
        ['url' => route('blog.show', ['id' => $blog->id, 'title' => Str::slug($blog->trans('title'))]), 'label' => $blog->trans('title')]
    ]" link-class="text-[#E9654B] hover:underline"/>
</div>

<!-- Blog Post Section -->
<div class="bg-white px-4 py-12 lg:px-6">
    <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">

        <!-- Blog Header Section -->
        <div class="text-center mb-8">
            <p class="text-base font-bold leading-7 text-[#E9654B] uppercase">{{ __('Introducing') }}</p> <!-- Made larger and bold -->
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $blog->trans('title') }}</h1>
            <p class="mt-4 text-sm leading-6 text-gray-500">{{ $blog->published_at->format('M d, Y') }}</p>
        </div>

        <!-- Blog Image Section -->
        <div class="mt-8">
            <img src="{{ Storage::url($blog->image ?? 'default_images/blog.jpg') }}"
                 alt="{{ $blog->getTranslation('title', app()->getLocale()) }}"
                 class="w-full rounded-lg shadow-md object-cover transition-transform duration-300 hover:scale-105"
                 style="aspect-ratio: 16/9; max-height: 320px;"> <!-- Image resized to smaller size -->
        </div>

        <!-- Blog Content Section -->
        <div class="mt-8">
            <article class="prose prose-lg max-w-none leading-7 text-gray-700">
                {!! $blog->trans('content') !!}
            </article>
        </div>

    </div>
</div>

@endsection
