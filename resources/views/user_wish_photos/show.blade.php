@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Add Breadcrumbs -->
    <x-breadcrumbs :links="[
        ['url' => route('main.index'), 'label' => __('Home')],
        ['url' => route('user-wish-photos.index'), 'label' => __('My Wish Photos')],
        ['url' => route('user-wish-photos.show', ['id' => $userWishPhoto->id]), 'label' => __('Photo Details')]
    ]"/>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="relative w-full" style="padding-top: 75%; /* Adjust this value based on the image's aspect ratio */">
                <img src="{{ asset('storage/' . $userWishPhoto->final_image_path) }}" alt="Wish Photo" class="absolute top-0 left-0 w-full h-full object-contain">
            </div>
            <div class="p-4">
                <p class="text-gray-600 mb-2">Created: {{ $userWishPhoto->created_at->format('M d, Y') }}</p>
                <p class="text-gray-600 mb-2">Likes: {{ $userWishPhoto->likes }} | Shares: {{ $userWishPhoto->shares }}</p>
                <div class="mt-4">
                    <!-- Download link -->
                    <a href="{{ route('user-wish-photos.download', $userWishPhoto->id) }}" class="text-green-500 hover:underline">Download Photo</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
