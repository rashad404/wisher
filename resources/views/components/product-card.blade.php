<!-- resources/views/components/product-card.blade.php -->

<div class="group relative bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 m-2">
    <a href="{{ route('products.show', $product->id) }}">
        <!-- Product Image -->
        <div class="aspect-w-1 aspect-h-1 bg-gray-200">
            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="object-cover object-center w-full h-full">
        </div>
        <!-- Product Details -->
        <div class="p-4 text-center">
            <h3 class="text-lg font-semibold text-gray-900">
                {{ $product->name }}
            </h3>
            <!-- Product Rating -->
            @php
                $averageRating = min($product->reviews->avg('rating'), 5);
                $fullStars = floor($averageRating);
                $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                $emptyStars = 5 - $fullStars - $halfStar;
            @endphp
            <div class="mt-2 flex items-center justify-center">
                @for ($i = 0; $i < $fullStars; $i++)
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.243 3.845a1 1 0 00.95.69h4.049c.969 0 1.371 1.24.588 1.81l-3.3 2.39a1 1 0 00-.364 1.118l1.243 3.845c.3.921-.755 1.688-1.538 1.118l-3.3-2.39a1 1 0 00-1.176 0l-3.3 2.39c-.783.57-1.838-.197-1.538-1.118l1.243-3.845a1 1 0 00-.364-1.118l-3.3-2.39c-.783-.57-.38-1.81.588-1.81h4.049a1 1 0 00.95-.69l1.243-3.845z" />
                    </svg>
                @endfor
                @if ($halfStar)
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <defs>
                            <linearGradient id="halfGradient">
                                <stop offset="50%" stop-color="currentColor"></stop>
                                <stop offset="50%" stop-color="transparent"></stop>
                            </linearGradient>
                        </defs>
                        <path fill="url(#halfGradient)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.243 3.845a1 1 0 00.95.69h4.049c.969 0 1.371 1.24.588 1.81l-3.3 2.39a1 1 0 00-.364 1.118l1.243 3.845c.3.921-.755 1.688-1.538 1.118l-3.3-2.39a1 1 0 00-1.176 0l-3.3 2.39c-.783.57-1.838-.197-1.538-1.118l1.243-3.845a1 1 0 00-.364-1.118l-3.3-2.39c-.783-.57-.38-1.81.588-1.81h4.049a1 1 0 00.95-.69l1.243-3.845z" />
                    </svg>
                @endif
                @for ($i = 0; $i < $emptyStars; $i++)
                    <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.243 3.845a1 1 0 00.95.69h4.049c.969 0 1.371 1.24.588 1.81l-3.3 2.39a1 1 0 00-.364 1.118l1.243 3.845c.3.921-.755 1.688-1.538 1.118l-3.3-2.39a1 1 0 00-1.176 0l-3.3 2.39c-.783.57-1.838-.197-1.538-1.118l1.243-3.845a1 1 0 00-.364-1.118l-3.3-2.39c-.783-.57-.38-1.81.588-1.81h4.049a1 1 0 00.95-.69l1.243-3.845z" />
                    </svg>
                @endfor
            </div>
            <p class="mt-1 text-sm text-gray-500">{{ number_format($averageRating, 1) }} / 5 ({{ $product->reviews->count() }} {{ __('reviews') }})</p>
            <!-- Product Price -->
            <p class="mt-4 text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
            <!-- Buy Now Button -->
            <div class="mt-4">
                <a href="{{ route('products.show', $product->id) }}" class="inline-block px-4 py-2 bg-[#E9654B] text-white rounded-md hover:bg-[#d45a43] transition-colors duration-300">
                    {{ __('messages.buy_now') }}
                </a>
            </div>
        </div>
    </a>
</div>
