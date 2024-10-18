@extends('layouts.app')

@section('content')

<!-- Breadcrumb Section -->
<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('messages.home')],
        ['url' => route('blog.index'), 'label' => __('messages.blog')],
    ]"/>
</div>

<!-- Blog Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ __('messages.from_the_blog') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('messages.blog_subtitle') }}</p>
        </div>

        <!-- Blog Posts Grid -->
        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($blogs as $blog)
            <div class="border rounded-lg shadow-sm overflow-hidden flex flex-col h-full hover:shadow-lg hover:-translate-y-2 transform transition-all duration-300">
                <div class="flex-shrink-0">
                    <!-- Blog Image -->
                    <img class="h-48 w-full object-cover" src="{{ Storage::url($blog->image ?? 'default_images/blog.jpg') }}" alt="{{ $blog->title }}">
                </div>
                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                    <!-- Blog Title -->
                    <h3 class="text-xl font-semibold text-gray-900">
                        <a href="{{ route('blog.show', ['id' => $blog->id, 'title' => Str::slug($blog->title)]) }}">{{ $blog->title }}</a>
                    </h3>
                    <!-- Blog Excerpt -->
                    <p class="mt-3 text-base text-gray-600">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                    <!-- Read More Link -->
                    <div class="mt-6">
                        <a href="{{ route('blog.show', ['id' => $blog->id, 'title' => Str::slug($blog->title)]) }}" class="text-[#E9654B] font-semibold hover:underline">{{ __('messages.read_more') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
