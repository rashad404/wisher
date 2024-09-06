@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-12">
    <div class="mx-auto max-w-7xl flex flex-col lg:flex-row">
        <!-- Mobile Hamburger Menu -->
        <div class="lg:hidden mb-4">
            <button id="hamburger-menu" class="bg-blue-600 text-white p-2 rounded-md w-full flex justify-between items-center">
                <span class="text-lg font-semibold">Filters</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <!-- Mobile Filter Menu -->
            <div id="mobile-menu" class="hidden bg-white p-4 rounded-md shadow">
                <h3 class="text-lg font-semibold mb-4">Filters</h3>
                <form id="filterFormMobile">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id ?? '' }}">
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Price Range</h4>
                        <input type="range" min="0" max="1000" value="0" step="10" class="w-full" id="priceRangeMobile" name="priceRange">
                        <div class="flex justify-between text-sm mt-2">
                            <span>$0</span>
                            <span id="priceRangeValueMobile">$0</span>
                        </div>
                    </div>
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

        <!-- Filter Sidebar for Desktop -->
        <div class="hidden lg:block w-1/4 pr-4 flex-shrink-0">
            <div class="bg-white p-4 rounded-md shadow h-full">
                <h3 class="text-lg font-semibold mb-4">Filters</h3>
                <form id="filterForm">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id ?? '' }}">
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Price Range</h4>
                        <input type="range" min="0" max="1000" value="0" step="10" class="w-full" id="priceRange" name="priceRange">
                        <div class="flex justify-between text-sm mt-2">
                            <span>$0</span>
                            <span id="priceRangeValue">$0</span>
                        </div>
                    </div>
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

        // Check if priceRange exists before adding event listener
        if (priceRange && priceRangeValue) {
            priceRange.addEventListener('input', function() {
                priceRangeValue.textContent = '$' + this.value;
            });
        }

        // Check for mobile price range
        const priceRangeMobile = document.getElementById('priceRangeMobile');
        const priceRangeValueMobile = document.getElementById('priceRangeValueMobile');

        if (priceRangeMobile && priceRangeValueMobile) {
            priceRangeMobile.addEventListener('input', function() {
                priceRangeValueMobile.textContent = '$' + this.value;
            });
        }

        // Check for filter form before adding change event
        if (filterForm) {
            filterForm.addEventListener('change', function() {
                const formData = new FormData(filterForm);
                if (priceRange) {
                    formData.set('priceRange', priceRange.value);
                }

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
                    if (productsGrid) {
                        productsGrid.innerHTML = ''; // Clear existing products

                        if (data.products && Array.isArray(data.products)) {
                            data.products.forEach(product => {
                                const averageRating = product.average_rating || 0; // Default to 0 if undefined
                                const numberOfReviews = product.number_of_reviews || 0; // Default to 0 if undefined

                                // Generate star rating HTML
                                const stars = Array.from({ length: 5 }, (_, index) => {
                                    const starClass = averageRating >= (index + 1) ? 'text-yellow-400' : 'text-gray-300';
                                    return <svg class="${starClass} h-5 w-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 17.27l5.18 3.07-1.39-6.09L21 9.24l-6.14-.53L12 3 9.14 8.71 3 9.24l4.21 4.04-1.39 6.09L12 17.27z"/>
                                    </svg>;
                                }).join('');

                                const productCardHTML =
                                    <div class="bg-white shadow-md rounded-lg p-4">
                                        <img src="${product.image_url}" alt="${product.title}" class="rounded-t-lg">
                                        <h3 class="mt-2 text-lg font-semibold">${product.title}</h3>
                                        <div class="flex items-center mb-2">
                                            <div class="flex">${stars}</div>
                                            <span class="text-gray-600 ml-2">(${numberOfReviews} reviews)</span>
                                        </div>
                                        <p class="text-gray-800">$${parseFloat(product.price).toFixed(2)}</p> <!-- Ensure price is a float -->
                                        <a href="/products/${product.id}" class="mt-4 block text-center text-blue-600 hover:underline">View Product</a>
                                    </div>
                                ;
                                productsGrid.insertAdjacentHTML('beforeend', productCardHTML);
                            });
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }

        // Toggle mobile filter menu
        const hamburgerMenu = document.getElementById('hamburger-menu');
        const mobileMenu = document.getElementById('mobile-menu');

        if (hamburgerMenu) {
            hamburgerMenu.addEventListener('click', function() {
                if (mobileMenu) {
                    mobileMenu.classList.toggle('hidden');
                }
            });
        }
    });
</script>


@endsection
