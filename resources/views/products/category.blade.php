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
        // Function to update price range display
        function updatePriceRange(input, display) {
            input.addEventListener('input', function() {
                display.textContent = '$' + this.value;
            });
        }

        const priceRange = document.getElementById('priceRange');
        const priceRangeValue = document.getElementById('priceRangeValue');
        const priceRangeMobile = document.getElementById('priceRangeMobile');
        const priceRangeValueMobile = document.getElementById('priceRangeValueMobile');
        const filterForm = document.getElementById('filterForm');
        const filterFormMobile = document.getElementById('filterFormMobile');
        const productsGrid = document.getElementById('productsGrid');

        // Set up price range listeners
        if (priceRange && priceRangeValue) {
            updatePriceRange(priceRange, priceRangeValue);
        }
        if (priceRangeMobile && priceRangeValueMobile) {
            updatePriceRange(priceRangeMobile, priceRangeValueMobile);
        }

        // Function to fetch products based on selected filters
        function fetchProducts(form) {
            const formData = new FormData(form);

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
                if (data.products && Array.isArray(data.products)) {
                    productsGrid.innerHTML = ''; // Clear existing products
                    data.products.forEach(product => {
                        const stars = generateStars(product.average_rating);
                        const numberOfReviews = product.number_of_reviews || 0;

                        const productCardHTML = `
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
                                    <p class="mt-4 text-base font-medium text-gray-900">$${parseFloat(product.price).toFixed(2)}</p>
                                </div>
                            </div>
                        `;
                        productsGrid.innerHTML += productCardHTML; // Append new product card
                    });
                }
            })
            .catch(error => console.error('Error fetching products:', error));
        }

        // Event listeners for desktop and mobile filter forms
        filterForm.addEventListener('change', function() {
            fetchProducts(this);
        });

        filterFormMobile.addEventListener('change', function() {
            fetchProducts(this);
        });

        // Toggle mobile menu
        document.getElementById('hamburger-menu').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    });

    // Function to generate star rating HTML
    function generateStars(rating) {
        let starsHTML = '';
        for (let i = 0; i < 5; i++) {
            starsHTML += i < rating ?
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="currentColor"><path d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-9.19-.77L12 2 10.19 8.47 1 9.24l5.46 4.73L5.82 21z" /></svg>' :
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="currentColor"><path d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-9.19-.77L12 2 10.19 8.47 1 9.24l5.46 4.73L5.82 21z" /></svg>';
        }
        return starsHTML;
    }
</script>

@endsection
