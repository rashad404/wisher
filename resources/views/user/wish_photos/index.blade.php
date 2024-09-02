@extends('layouts.user.app')

@section('content')
<div class="p-6">
    <!-- Add Breadcrumbs -->
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.wish-photos.index'), 'label' => __('My Wish Photos')],
    ]"/>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Page Title and Create New Button -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">My Wish Photos</h1>
        <a href="{{ route('wish-photos') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow-md transition-colors duration-200">
            Create New Wish Photo
        </a>
    </div>

    <!-- User Wish Photos Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($userWishPhotos as $photo)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('storage/' . $photo->final_image_path) }}" alt="Wish Photo" class="w-full h-48 object-cover">
                <div class="p-4">
                    <p class="text-gray-600 mb-2">Created: {{ $photo->created_at->format('M d, Y') }}</p>
                    <p class="text-gray-600 mb-4">Likes: {{ $photo->likes }} | Shares: {{ $photo->shares }}</p>
                    <a href="{{ route('user.wish-photos.show', $photo->id) }}" class="block w-full text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition-colors duration-200">
                        View
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
