@extends('layouts.app')

@section('content')

<!-- Breadcrumbs Section -->
<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Home')],
        ['url' => route('wish-photos'), 'label' => __('Wish Photos')]
    ]"/>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Page Header with Title and Description -->
    <div class="flex flex-col items-center text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Create Your Perfect Wish Photo</h1>
        <p class="text-lg text-gray-600 max-w-2xl">
            Choose from our beautiful templates to create a personalized wish photo for your loved ones. Select a template below to start customizing.
        </p>
    </div>

    <!-- Templates Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($templates as $template)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <!-- Template Image -->
                <img src="{{ asset('storage/' . $template->image_path) }}" alt="{{ $template->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <!-- Template Name -->
                    <h5 class="text-lg font-semibold text-gray-800 mb-1">{{ $template->name }}</h5>
                    <!-- Template Category -->
                    <p class="text-sm text-gray-500 mb-4">Category: {{ $template->category }}</p>
                    <!-- Use Template Button -->
                    <a href="{{ route('user-wish-photos.create', ['templateId' => $template->id]) }}" class="block w-full text-center bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Customize This Template
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
