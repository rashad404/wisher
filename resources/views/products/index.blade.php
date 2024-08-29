@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
        <h2 class="sr-only">Products</h2>

        <div class="-mx-px grid grid-cols-2 border-l border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($products as $product)
                <div class="group relative border-b border-r border-gray-200 p-4 sm:p-6">
                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200 group-hover:opacity-75">
                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="pb-4 pt-10 text-center">
                        <h3 class="text-sm font-medium text-gray-900">
                            <a href="{{ route('products.show', $product->id) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $product->name }}
                            </a>
                        </h3>
                        <div class="mt-3 flex flex-col items-center">
                            @php
                                $averageRating = min($product->reviews->avg('rating'), 5); // Ensure rating does not exceed 5
                                $fullStars = floor($averageRating);
                                $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - $fullStars - $halfStar;
                            @endphp

                            <div class="flex items-center">
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 17.27l5.18 3.43-1.39-6.06L22 9.24l-6.16-.53L12 2 8.16 8.71 2 9.24l4.21 4.4-1.39 6.06L12 17.27z"/>
                                    </svg>
                                @endfor

                                @if ($halfStar)
                                    <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <defs>
                                            <mask id="half-mask">
                                                <rect x="0" y="0" width="100%" height="100%" fill="white"/>
                                                <rect x="50%" y="0" width="50%" height="100%" fill="black"/>
                                            </mask>
                                        </defs>
                                        <path d="M12 17.27l5.18 3.43-1.39-6.06L22 9.24l-6.16-.53L12 2 8.16 8.71 2 9.24l4.21 4.4-1.39 6.06L12 17.27z" mask="url(#half-mask)" />
                                    </svg>
                                @endif

                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <svg class="text-gray-300 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 17.27l5.18 3.43-1.39-6.06L22 9.24l-6.16-.53L12 2 8.16 8.71 2 9.24l4.21 4.4-1.39 6.06L12 17.27z"/>
                                    </svg>
                                @endfor
                            </div>

                            <p class="sr-only">{{ number_format($averageRating, 1) }} out of 5 stars</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $product->reviews->count() }} reviews</p>
                        </div>
                        <p class="mt-4 text-base font-medium text-gray-900">${{ $product->price }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
