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

    /* CSS for desktop dropdowns */
    .subcategory-list {
        display: none;
        position: absolute;
        top: 0;
        left: calc(100% + 12px);
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 0.25rem;
        z-index: 10;
        min-width: 200px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .category-item {
        position: relative;
    }

    .category-item:hover .subcategory-list {
        display: block;
    }

    .subcategory-list a {
        padding: 0.5rem 1rem;
        display: block;
    }
</style>

<div class="bg-gray-100 py-12">
    <div class="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
        <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.giftsTitle') }}</h2>
        <p class="text-center mt-4 mb-16 text-lg text-gray-600">{{ __('messages.giftsSubTitle') }}</p>

        <div class="flex flex-col lg:flex-row">
            <!-- Mobile Hamburger Menu -->
            <div class="lg:hidden mb-4">
                <button id="hamburger-menu" class="bg-blue-600 text-white p-2 rounded-md w-full flex justify-between items-center">
                    <span class="text-lg font-semibold">Categories and Filters</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>

                <!-- Mobile Category List -->
                <ul id="mobile-menu" class="hidden space-y-2 bg-white p-4 rounded-md shadow">
                    @foreach ($categories[null] as $parentCategory)
                        <li class="relative group">
                            <a href="javascript:void(0)" class="block p-2 rounded-md category-link hover:bg-gray-200" data-category-id="{{ $parentCategory->id }}">{{ $parentCategory->name }}</a>

                            <!-- Subcategory List (Initially hidden) -->
                            <ul id="subcategory-{{ $parentCategory->id }}" class="mt-2 hidden bg-white border border-gray-200 rounded-md shadow-lg">
                                @if(isset($categories[$parentCategory->id]))
                                    @foreach ($categories[$parentCategory->id] as $subcategory)
                                        <li>
                                            <a href="{{ route('category', ['id' => $subcategory->id]) }}" class="block p-2 rounded-md subcategory-link">{{ $subcategory->name }}</a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-gray-500">No subcategories</li>
                                @endif
                            </ul>
                        </li>
                    @endforeach

                    <!-- Filters Section -->
                    <h3 class="text-lg font-semibold mb-4 mt-6">Filters</h3>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">Price Range</h4>
                        <input type="range" min="0" max="1000" value="0" step="10" class="w-full" id="priceRangeMobile" name="priceRange">
                        <div class="flex justify-between text-sm mt-2">
                            <span>$0</span>
                            <span id="priceRangeValueMobile">$0</span>
                        </div>
                    </div>

                    <!-- Color Filter (Collapsible) -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2 cursor-pointer" id="colorToggleMobile">Color</h4>
                        <div class="space-y-2 hidden" id="colorOptionsMobile">
                            @foreach ($colors as $color)
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2" name="colors[]" value="{{ $color->id }}">
                                    <span class="inline-block w-4 h-4 mr-2" style="background-color: {{ strtolower($color->name) }};"></span>
                                    <span>{{ $color->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Size Filter (Collapsible) -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2 cursor-pointer" id="sizeToggleMobile">Size</h4>
                        <div class="space-y-2 hidden" id="sizeOptionsMobile">
                            @foreach ($sizes as $size)
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2" name="sizes[]" value="{{ $size->id }}">
                                    <span>{{ $size->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Brand Filter (Collapsible) -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2 cursor-pointer" id="brandToggleMobile">Brand</h4>
                        <div class="space-y-2 hidden" id="brandOptionsMobile">
                            @foreach ($brands as $brand)
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2" name="brands[]" value="{{ $brand->id }}">
                                    <span>{{ $brand->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </ul>
            </div>


            <!-- Desktop Category Filter and Filters -->
            <div class="hidden lg:block w-1/4 pr-4">
                <div class="bg-blue-600 text-white p-2 rounded-md">
                    <h3 class="text-lg font-semibold">Categories</h3>
                </div>
                <ul class="mt-2 space-y-2 bg-white p-4 rounded-md shadow">
                    @foreach ($categories[null] as $parentCategory)
                        <li class="relative category-item">
                            <a href="{{ route('category', ['id' => $parentCategory->id]) }}" class="block p-2 rounded-md category-link hover:bg-gray-200">{{ $parentCategory->name }}</a>

                            <!-- Subcategory List -->
                            <ul class="subcategory-list">
                                @if(isset($categories[$parentCategory->id]))
                                    @foreach ($categories[$parentCategory->id] as $subcategory)
                                        <li>
                                            <a href="{{ route('category', ['id' => $subcategory->id]) }}" class="block p-2 rounded-md subcategory-link">{{ $subcategory->name }}</a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-gray-500">No subcategories</li>
                                @endif
                            </ul>
                        </li>
                    @endforeach
                </ul>

                <!-- Filters Section -->
                <div class="mt-6">
                    <div class="bg-blue-600 text-white p-2 rounded-md">
                        <h3 class="text-lg font-semibold">Filters</h3>
                    </div>

                    <div class="bg-white p-4 rounded-md shadow h-full mt-2 space-y-2">
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

                            <!-- Color Filter (Collapsible) -->
                            <div class="mb-6">
                                <h4 class="text-md font-semibold mb-2 cursor-pointer" id="colorToggle">Color</h4>
                                <div class="space-y-2" id="colorOptions" style="display: none;">
                                    @foreach ($colors as $color)
                                        <label class="flex items-center">
                                            <input type="checkbox" class="mr-2" name="colors[]" value="{{ $color->id }}">
                                            <span class="inline-block w-4 h-4 mr-2" style="background-color: {{ strtolower($color->name) }};"></span>
                                            <span>{{ $color->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Size Filter (Collapsible) -->
                            <div class="mb-6">
                                <h4 class="text-md font-semibold mb-2 cursor-pointer" id="sizeToggle">Size</h4>
                                <div class="space-y-2" id="sizeOptions" style="display: none;">
                                    @foreach ($sizes as $size)
                                        <label class="flex items-center">
                                            <input type="checkbox" class="mr-2" name="sizes[]" value="{{ $size->id }}">
                                            <span>{{ $size->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Brand Filter (Collapsible) -->
                            <div class="mb-6">
                                <h4 class="text-md font-semibold mb-2 cursor-pointer" id="brandToggle">Brand</h4>
                                <div class="space-y-2" id="brandOptions" style="display: none;">
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
            </div>

            <!-- Products Grid -->
            <div class="flex-1">
                <div class="-mx-px grid grid-cols-2 border-l border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('hamburger-menu').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });

    document.querySelectorAll('.category-link').forEach(item => {
        item.addEventListener('click', function () {
            const categoryId = this.getAttribute('data-category-id');
            const subcategoryList = document.getElementById('subcategory-' + categoryId);

            if (subcategoryList) {
                subcategoryList.classList.toggle('hidden');
            }
        });
    });

    // Toggle Color options
    document.getElementById('colorToggle').addEventListener('click', function () {
        const colorOptions = document.getElementById('colorOptions');
        colorOptions.style.display = colorOptions.style.display === 'none' ? 'block' : 'none';
    });

    // Toggle Size options
    document.getElementById('sizeToggle').addEventListener('click', function () {
        const sizeOptions = document.getElementById('sizeOptions');
        sizeOptions.style.display = sizeOptions.style.display === 'none' ? 'block' : 'none';
    });

    // Toggle Brand options
    document.getElementById('brandToggle').addEventListener('click', function () {
        const brandOptions = document.getElementById('brandOptions');
        brandOptions.style.display = brandOptions.style.display === 'none' ? 'block' : 'none';
    });

    // Toggle Color options (Mobile)
    document.getElementById('colorToggleMobile').addEventListener('click', function () {
        const colorOptions = document.getElementById('colorOptionsMobile');
        colorOptions.classList.toggle('hidden');
    });

    // Toggle Size options (Mobile)
    document.getElementById('sizeToggleMobile').addEventListener('click', function () {
        const sizeOptions = document.getElementById('sizeOptionsMobile');
        sizeOptions.classList.toggle('hidden');
    });

    // Toggle Brand options (Mobile)
    document.getElementById('brandToggleMobile').addEventListener('click', function () {
        const brandOptions = document.getElementById('brandOptionsMobile');
        brandOptions.classList.toggle('hidden');
    });

</script>
@endsection
