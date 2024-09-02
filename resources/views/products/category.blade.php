@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-12">
    <div class="mx-auto max-w-7xl flex">

        <!-- Filter Sidebar -->
        <div class="w-1/4 pr-4 flex-shrink-0">
            <div class="bg-white p-4 rounded-md shadow h-full">
                <h3 class="text-lg font-semibold mb-4">Filters</h3>

                <!-- Price Range Filter -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold mb-2">Price Range</h4>
                    <input type="range" min="0" max="1000" value="0" step="10" class="w-full" id="priceRange">
                    <div class="flex justify-between text-sm mt-2">
                        <span>$0</span>
                        <span id="priceRangeValue">$1000</span>
                    </div>
                </div>

                <!-- Color Filter -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold mb-2">Color</h4>
                    <div class="space-y-2">
                        @foreach ($colors as $color)
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2" name="color" value="{{ $color->id }}">
                                <span>{{ $color->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Brand Filter -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold mb-2">Brand</h4>
                    <select class="w-full border-gray-300 rounded-md">
                        <option value="">Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Other Filters -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold mb-2">Other Filters</h4>
                    <!-- Example: Checkbox for in-stock items -->
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2" name="in_stock">
                        <span>In Stock</span>
                    </label>
                    <!-- Add more filters as needed -->
                </div>

                <button class="w-full bg-blue-600 text-white py-2 rounded-md">Apply Filters</button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="flex-1">
            <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $category->name }}</h2>
            <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    // Script to update price range value display
    const priceRange = document.getElementById('priceRange');
    const priceRangeValue = document.getElementById('priceRangeValue');

    priceRange.addEventListener('input', function() {
        priceRangeValue.textContent = '$' + this.value;
    });
</script>
@endsection
