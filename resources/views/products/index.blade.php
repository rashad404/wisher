@extends('layouts.app')

@section('content')
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
                        <li>
                            <a href="#" class="block p-2 rounded-md hover:bg-gray-200">{{ $parentCategory->name }}</a>
                            <ul class="pl-4">
                                @if(isset($categories[$parentCategory->id]))
                                    @foreach ($categories[$parentCategory->id] as $subcategory)
                                        <li>
                                            <a href="#" class="block p-2 rounded-md hover:bg-gray-200">{{ $subcategory->name }}</a>
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
@endsection
