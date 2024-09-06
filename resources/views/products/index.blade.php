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
    <div class="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
        <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('messages.giftsTitle') }}</h2>
        <p class="text-center mt-4 mb-16 text-lg text-gray-600">{{ __('messages.giftsSubTitle') }}</p>

        <div class="flex flex-col lg:flex-row">
            <!-- Mobile Hamburger Menu -->
            <div class="lg:hidden mb-4">
                <button id="hamburger-menu" class="bg-blue-600 text-white p-2 rounded-md w-full flex justify-between items-center">
                    <span class="text-lg font-semibold">Categories</span>
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
                </ul>
            </div>

            <!-- Desktop Category Filter -->
            <div class="hidden lg:block w-1/4 pr-4">
                <div class="bg-blue-600 text-white p-2 rounded-md">
                    <h3 class="text-lg font-semibold">Categories</h3>
                </div>
                <ul class="mt-2 space-y-2 bg-white p-4 rounded-md shadow">
                    @foreach ($categories[null] as $parentCategory)
                        <li class="relative group">
                            <a href="{{ route('category', ['id' => $parentCategory->id]) }}" class="block p-2 rounded-md category-link hover:bg-gray-200">{{ $parentCategory->name }}</a>

                            <!-- Subcategory List -->
                            <ul class="absolute left-full top-0 mt-0 hidden w-48 bg-white border border-gray-200 rounded-md shadow-lg group-hover:block z-10 ml-4">
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
</script>
@endsection
