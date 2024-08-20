@extends('layouts.app')

@section('content')
<div class="bg-white px-6 py-32 lg:px-8">
    <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">
        <p class="text-base font-semibold leading-7 text-indigo-600">{{ __('Introducing') }}</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $blog->getTranslation('title', app()->getLocale()) }}</h1>
        <p class="mt-6 text-xl leading-8">{{ $blog->published_at->format('M d, Y') }}</p>
        <div class="mt-10 max-w-2xl">
            {!! $blog->getTranslation('content', app()->getLocale()) !!}
        </div>
    </div>
</div>
@endsection
