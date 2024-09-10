@extends('layouts.app')

@section('content')
<style>
    .category-link {
        color: black;
        transition: color 0.3s;
    }

    .category-link:hover {
        color: blue;
        background-color: white;
    }

    .subcategory-link {
        color: black;
        transition: color 0.3s;
    }

    .subcategory-link:hover {
        color: blue;
        background-color: white;
    }
</style>
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

                    <!-- Category Section -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Categories</h4>
                        <ul class="space-y-2 bg-white p-4 rounded-md shadow">
                            @foreach ($categories[null] as $parentCategory)
                                <li class="relative group">
                                    <div class="flex justify-between items-center">
                                        <a href="javascript:void(0)"
                                           class="block p-2 rounded-md category-link hover:bg-gray-200"
                                           data-category-id="{{ $parentCategory->id }}"
                                           onclick="toggleSubcategories('subcategory-{{ $parentCategory->id }}', 'arrow-{{ $parentCategory->id }}')">
                                            {{ $parentCategory->name }}
                                        </a>
                                        <span class="toggle-icon" id="arrow-{{ $parentCategory->id }}">&#8594;</span>
                                    </div>
                                    <!-- Subcategory List (Initially hidden) -->
                                    <ul id="subcategory-{{ $parentCategory->id }}" class="mt-2 hidden bg-white border border-gray-200 rounded-md shadow-lg">
                                        @if(isset($categories[$parentCategory->id]))
                                            @foreach ($categories[$parentCategory->id] as $subcategory)
                                                <li>
                                                    <a href="{{ route('category', ['id' => $subcategory->id]) }}" class="block p-2 rounded-md subcategory-link hover:bg-gray-200">{{ $subcategory->name }}</a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="text-gray-500">No subcategories</li>
                                        @endif
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Price Range</h4>
                        <input type="range" min="0" max="1000" value="0" step="10" class="w-full" id="priceRangeMobile" name="priceRange">
                        <div class="flex justify-between text-sm mt-2">
                            <span>$0</span>
                            <span id="priceRangeValueMobile">$0</span>
                        </div>
                    </div>

                    <!-- Color Part Mobile -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2 cursor-pointer" onclick="toggleSection('colorSection', 'colorToggle')">
                            Color <span class="toggle-icon" id="colorToggle">&#8594;</span>
                        </h4>
                        <div class="collapsible-content" id="colorSection" style="display: none;">
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
                    </div>

                    <!-- Size Part Mobile -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2 cursor-pointer" onclick="toggleSection('sizeSection', 'sizeToggle')">
                            Size <span class="toggle-icon" id="sizeToggle">&#8594;</span>
                        </h4>
                        <div class="collapsible-content" id="sizeSection" style="display: none;">
                            <div class="space-y-2">
                                @foreach ($sizes as $size)
                                    <label class="flex items-center">
                                        <input type="checkbox" class="mr-2" name="sizes[]" value="{{ $size->id }}">
                                        <span>{{ $size->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Brand Part Mobile -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2 cursor-pointer" onclick="toggleSection('brandSection', 'brandToggle')">
                            Brands <span class="toggle-icon" id="brandToggle">&#8594;</span>
                        </h4>
                        <div class="collapsible-content" id="brandSection" style="display: none;">
                            <div class="space-y-2">
                                @foreach ($brands as $brand)
                                    <label class="flex items-center">
                                        <input type="checkbox" class="mr-2" name="brands[]" value="{{ $brand->id }}">
                                        <span>{{ $brand->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Filter Sidebar for Desktop -->
        <div class="hidden lg:block w-1/4 pr-4 flex-shrink-0">
            <div class="bg-white p-4 rounded-md shadow h-full">
                <!-- Filters Section -->
                <h3 class="text-lg font-semibold mb-4">Filters</h3>
                <form id="filterForm">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id ?? '' }}">

                    <!-- Price Range -->
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
                        <h4 class="text-md font-semibold mb-2 cursor-pointer" onclick="toggleSection('desktopColorSection', 'desktopColorToggle')">
                            Color<span class="toggle-icon" id="desktopColorToggle">&#8594;</span>
                        </h4>
                        <div class="collapsible-content" id="desktopColorSection" style="display: none;">
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
                    </div>

                    <!-- Size Filter -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2 cursor-pointer" onclick="toggleSection('desktopSizeSection', 'desktopSizeToggle')">
                            Size <span class="toggle-icon" id="desktopSizeToggle">&#8594;</span>
                        </h4>
                        <div class="collapsible-content" id="desktopSizeSection" style="display: none;">
                            <div class="space-y-2">
                                @foreach ($sizes as $size)
                                    <label class="flex items-center">
                                        <input type="checkbox" class="mr-2" name="sizes[]" value="{{ $size->id }}">
                                        <span>{{ $size->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Brand Filter -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2 cursor-pointer" onclick="toggleSection('desktopBrandSection', 'desktopBrandToggle')">
                            Brand <span class="toggle-icon" id="desktopBrandToggle">&#8594;</span>
                        </h4>
                        <div class="collapsible-content" id="desktopBrandSection" style="display: none;">
                            <div class="space-y-2">
                                @foreach ($brands as $brand)
                                    <label class="flex items-center">
                                        <input type="checkbox" class="mr-2" name="brands[]" value="{{ $brand->id }}">
                                        <span>{{ $brand->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <!-- Categories Section -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-2">Categories</h4>
                        <ul class="mt-2 space-y-2 bg-white p-4 rounded-md shadow">
                            @foreach ($categories[null] as $parentCategory)
                                <li class="relative">
                                    <div class="flex justify-between items-center cursor-pointer"
                                         onclick="toggleSubcategories('desktop-subcat-{{ $parentCategory->id }}', 'desktop-arrow-{{ $parentCategory->id }}')">
                                        <span class="block p-2 rounded-md category-link hover:bg-gray-200">{{ $parentCategory->name }}</span>
                                        <!-- Use different arrows for collapsed and expanded states -->
                                        <span class="toggle-icon" id="desktop-arrow-{{ $parentCategory->id }}">&#8594;</span>
                                    </div>

                                    <!-- Subcategory List -->
                                    <ul class="hidden mt-2 ml-4 bg-white border border-gray-200 rounded-md shadow-lg" id="desktop-subcat-{{ $parentCategory->id }}">
                                        @if(isset($categories[$parentCategory->id]) && count($categories[$parentCategory->id]) > 0)
                                            @foreach ($categories[$parentCategory->id] as $subcategory)
                                                <li>
                                                    <a href="{{ route('category', ['id' => $subcategory->id]) }}" class="block p-2 rounded-md subcategory-link hover:bg-gray-100">{{ $subcategory->name }}</a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="text-gray-500">No subcategories</li>
                                        @endif
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </form>
            </div>
        </div>



        <!-- Products Grid -->
        <div class="flex-1">
            <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $category->name }} Products</h2>
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
    const priceRangeMobile = document.getElementById('priceRangeMobile');
    const priceRangeValueMobile = document.getElementById('priceRangeValueMobile');
    const filterForm = document.getElementById('filterForm');
    const filterFormMobile = document.getElementById('filterFormMobile');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerMenu = document.getElementById('hamburger-menu');

    // Update price range display
    priceRange.addEventListener('input', function() {
        priceRangeValue.textContent = '$' + this.value;
    });

    priceRangeMobile.addEventListener('input', function() {
        priceRangeValueMobile.textContent = '$' + this.value;
    });

    // Toggle mobile filter menu
    hamburgerMenu.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });

    if (filterForm) {
        filterForm.addEventListener('change', function() {
            const formData = new FormData(filterForm);
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
                        const averageRating = product.average_rating || 0;
                        const numberOfReviews = product.number_of_reviews || 0;

                        // Generate star rating HTML
                        const stars = Array.from({ length: 5 }, (_, index) => {
                            const starClass = averageRating >= (index + 1) ? 'text-yellow-400' : 'text-gray-300';
                            return `<svg class="${starClass} h-5 w-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 17.27l5.18 3.07-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.07L5.82 20.34z"/>
                            </svg>`;
                        }).join('');

                        // Create product card
                        productsGrid.innerHTML += `
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
                            </div>`;
                    });
                }
            });
        });
    }

    if (filterFormMobile) {
        filterFormMobile.addEventListener('change', function() {
            const formData = new FormData(filterFormMobile);
            formData.set('priceRange', priceRangeMobile.value);

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
                        const averageRating = product.average_rating || 0;
                        const numberOfReviews = product.number_of_reviews || 0;

                        // Generate star rating HTML
                        const stars = Array.from({ length: 5 }, (_, index) => {
                            const starClass = averageRating >= (index + 1) ? 'text-yellow-400' : 'text-gray-300';
                            return `<svg class="${starClass} h-5 w-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 17.27l5.18 3.07-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.07L5.82 20.34z"/>
                            </svg>`;
                        }).join('');

                        // Create product card
                        productsGrid.innerHTML += `
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
                            </div>`;
                    });
                }
            });
        });
    }
});

//Make mobile part Collapsible
function toggleSection(sectionId, toggleId) {
    const section = document.getElementById(sectionId);
    const toggleIcon = document.getElementById(toggleId);

    if (section.style.display === 'none' || section.style.display === '') {
        section.style.display = 'block';
        toggleIcon.innerHTML = '&#8595;'; // Down arrow
    } else {
        section.style.display = 'none';
        toggleIcon.innerHTML = '&#8594;'; // Right arrow
    }
}

//Category and Subcategory part
function toggleSubcategories(subcategoryId, arrowId) {
    const subcategory = document.getElementById(subcategoryId);
    const arrow = document.getElementById(arrowId);

    if (subcategory.style.display === 'none' || subcategory.style.display === '') {
        subcategory.style.display = 'block';
        arrow.innerHTML = '&#8595;';
    } else {
        subcategory.style.display = 'none';
        arrow.innerHTML = '&#8594;';
    }
}

</script>
@endsection
