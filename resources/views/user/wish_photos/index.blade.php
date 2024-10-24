@extends('layouts.user.app')

@section('content')
<div class="p-6">
    <!-- Breadcrumbs -->
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.wish-photos.index'), 'label' => __('My Wish Photos')],
    ]"/>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Page Title and Create Button -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">My Wish Photos</h1>
        <a href="{{ route('wish-photos') }}" class="bg-[#E9654B] hover:bg-[#e65b39] text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-300">
            Create New Wish Photo
        </a>
    </div>

    <!-- User Wish Photos Grid -->
    @if($userWishPhotos->isEmpty())
        <p class="text-gray-500 text-center">No wish photos found. Start by creating a new one!</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($userWishPhotos as $photo)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                    <img src="{{ asset('storage/' . $photo->final_image_path) }}" alt="Wish Photo" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <p class="text-sm text-gray-600 mb-1">Created: <span class="font-semibold">{{ $photo->created_at->format('M d, Y') }}</span></p>
                        <p class="text-sm text-gray-600 mb-4">Likes: <span class="font-semibold">{{ $photo->likes }}</span> | Shares: <span class="font-semibold">{{ $photo->shares }}</span></p>
                        <a href="{{ route('user.wish-photos.show', $photo->id) }}" class="block w-full text-center bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-500 transition duration-300">
                            View Wish Photo
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $userWishPhotos->links() }}
        </div>
    @endif
</div>
@endsection
