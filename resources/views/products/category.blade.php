@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-12">
    <div class="mx-auto max-w-7xl flex">
        <!-- Filter Sidebar -->
        <div class="w-1/4 pr-4 flex-shrink-0">
            <div class="bg-white p-4 rounded-md shadow h-full">
                <h3 class="text-lg font-semibold mb-4">Filters</h3>
                <!-- Filter Form -->
                <form id="filterForm">
                    @csrf
                    <!-- Include category ID -->
                    <input type="hidden" name="category_id" value="{{ $category->id ?? '' }}">
                    <!-- Price Range Filter -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Price Range</h4>
                        <input type="range" min="0" max="1000" value="0" step="10" class="w-full" id="priceRange" name="priceRange">
                        <div class="flex justify-between text-sm mt-2">
                            <span>$0</span>
                            <span id="priceRangeValue">$0</span>
                        </div>
                    </div>

                    <!-- Color Filter -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Color</h4>
                        <div class="space-y-2">
                            @foreach ($colors as $color)
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2" name="colors[]" value="{{ $color->id }}">
                                    <span class="inline-block w-4 h-4 mr-2" style="background-color: {{ strtolower($color->name) }};"></span>
                                    <span>{{ $color->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>


                    <!-- Size Filter -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Size</h4>
                        <div class="space-y-2">
                            @foreach ($sizes as $size)
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2" name="sizes[]" value="{{ $size->id }}">
                                    <span>{{ $size->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>


                    <!-- Brand Filter -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Brand</h4>
                        <div class="space-y-2">
                            @foreach ($brands as $brand)
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2" name="brands[]" value="{{ $brand->id }}">
                                    <span>{{ $brand->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="flex-1">
            <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $category->name ?? 'Products' }}</h2>
            <div id="productsGrid" class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceRange = document.getElementById('priceRange');
        const priceRangeValue = document.getElementById('priceRangeValue');
        const filterForm = document.getElementById('filterForm');

        // Update price range display
        priceRange.addEventListener('input', function() {
            priceRangeValue.textContent = '$' + this.value;
        });

        if (filterForm) {
            filterForm.addEventListener('change', function() {
                const formData = new FormData(filterForm);

                // Include price range in FormData
                formData.set('priceRange', priceRange.value);

                fetch("{{ route('products.filter') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const productsGrid = document.getElementById('productsGrid');
                    productsGrid.innerHTML = ''; // Clear existing products

                    if (data.products && Array.isArray(data.products)) {
                        data.products.forEach(product => {
                            const averageRating = product.average_rating || 0; // Default to 0 if undefined
                            const numberOfReviews = product.number_of_reviews || 0; // Default to 0 if undefined

                            // Generate star rating HTML
                            const stars = Array.from({ length: 5 }, (_, index) => {
                                const starClass = averageRating >= (index + 1) ? 'text-yellow-400' : 'text-gray-300';
                                return `<svg class="${starClass} h-5 w-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 17.27l5.18 3.07-1.39-6.09L21 9.24l-6.14-.53L12 3 9.14 8.71 3 9.24l4.21 4.04-1.39 6.09L12 17.27z"></path>
                                </svg>`;
                            }).join('');

                            // Create review HTML
                            const reviewText = numberOfReviews > 0
                                ? `<p class="mt-2 text-sm text-gray-600">Average Rating: ${averageRating.toFixed(1)} (${numberOfReviews} ${numberOfReviews === 1 ? 'review' : 'reviews'})</p>`
                                : '<p class="mt-2 text-sm text-gray-600">No reviews yet</p>';

                            const productCard = `
                                <div class="bg-white group relative border-b border-r border-gray-200 p-4 sm:p-6 m-1">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200 group-hover:opacity-75">
                                        <img src="{{ asset('storage/') }}/${product.main_image}" alt="${product.name}" class="h-full w-full object-cover object-center">
                                    </div>
                                    <div class="pb-4 pt-10 text-center">
                                        <h3 class="text-sm font-medium text-gray-900">
                                            <a href="/products/${product.id}">
                                                <span aria-hidden="true" class="absolute inset-0"></span>
                                                ${product.name}
                                            </a>
                                        </h3>
                                        <div class="mt-3 flex flex-col items-center">
                                            <div class="flex items-center">
                                                ${stars}
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500">${numberOfReviews} reviews</p>
                                        </div>
                                        <p class="mt-4 text-base font-medium text-gray-900">$${product.price}</p>
                                    </div>
                                </div>
                            `;
                            productsGrid.insertAdjacentHTML('beforeend', productCard);
                        });
                    } else {
                        console.error('No products found or response is invalid:', data);
                    }
                })
                .catch(error => console.error('Error fetching products:', error));
            });
        }
    });
</script>
@endsection
