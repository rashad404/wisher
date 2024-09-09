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

        <div class="flex">
            <!-- Category Filter -->
            <div class="w-1/4 pr-4">
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
    document.querySelectorAll('.relative').forEach(item => {
        const subcategoryList = item.querySelector('ul');

        item.addEventListener('mouseenter', () => {
            if (subcategoryList) {
                subcategoryList.classList.remove('hidden');
            }
        });

        item.addEventListener('mouseleave', () => {
            if (subcategoryList) {
                setTimeout(() => {
                    if (!subcategoryList.matches(':hover') && !item.matches(':hover')) {
                        subcategoryList.classList.add('hidden');
                    }
                }, 100);
            }
        });

        if (subcategoryList) {
            subcategoryList.addEventListener('mouseenter', () => {
                subcategoryList.classList.remove('hidden');
            });

            subcategoryList.addEventListener('mouseleave', () => {
                subcategoryList.classList.add('hidden');
            });
        }
    });
</script>
@endsection
