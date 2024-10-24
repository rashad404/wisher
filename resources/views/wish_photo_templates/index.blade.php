@extends('layouts.app')

@section('content')

<!-- Breadcrumbs Section -->
<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Home')],
        ['url' => route('wish-photos'), 'label' => __('Wish Photos')]
    ]"/>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Page Header with Title and Description -->
    <div class="text-center mb-16"> <!-- Increased margin-bottom to 16 for more spacing -->
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Create Your Perfect Wish Photo</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Choose from our beautiful templates to create a personalized wish photo for your loved ones. Select a template below to start customizing.
        </p>
    </div>

    <!-- Templates Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($templates as $template)
            <div class="relative group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <!-- Template Image with Subtle Zoom on Hover -->
                <div class="overflow-hidden">
                    <img src="{{ asset('storage/' . $template->image_path) }}" alt="{{ $template->name }}" class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <!-- Template Name -->
                    <h5 class="text-lg font-semibold text-gray-800 mb-2">{{ $template->name }}</h5>
                    <!-- Template Category -->
                    <p class="text-sm text-gray-500 mb-4">Category: {{ $template->category }}</p>
                    <!-- Use Template Button -->
                    <a href="{{ route('user.wish-photos.create', ['templateId' => $template->id]) }}" class="inline-block w-full text-center bg-[#E9654B] text-white font-medium py-3 rounded-md hover:bg-[#d45a43] transition-colors duration-300">
                        Customize This Template
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
