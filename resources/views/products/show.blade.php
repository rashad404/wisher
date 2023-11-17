@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>
        <div class="bg-white shadow-lg rounded-lg p-6 mt-4">
            <p class="text-gray-600">{{ $product->description }}</p>
            <p class="mt-4 text-lg font-semibold">${{ $product->price }}</p>
            <div id="variant-selector">
                <!-- Color buttons -->
            <!-- Display unique colors -->
            @if (!empty($uniqueColors))
                <h2 class="text-xl font-semibold mt-6">Available Colors</h2>
                <div class="flex mt-2">
                    @foreach ($uniqueColors as $colorId)
                        @php
                            $colorVariant = $product->variants->where('color_id', $colorId)->first();
                        @endphp
                        @if ($colorVariant)
                            <div class="mr-2">
                                <button class="h-8 w-8 rounded-full border" style="background-color: {{ $colorVariant->color->name }}" onclick="selectColor({{ $colorVariant->color->id }})"></button>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="mt-6">No available colors for this product.</p>
            @endif
                <!-- Size buttons -->
                <div class="mt-4" id="size-select">
                    <h2 class="text-xl font-semibold">Sizes</h2>
                    <div class="flex mt-2">
                        @foreach ($product->variants as $variant)
                            @if ($variant->size)
                                <div class="mr-2">
                                    <button class="px-3 py-1 border rounded"
                                        onclick="selectSize('{{ $variant->size->id }}')">{{ $variant->size->name }}</button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- Available Quantity -->
                <div class="mt-4" id="quantity-display">
                    <h2 class="text-xl font-semibold">Available Quantity</h2>
                    <p>Select both color and size to see available quantity.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedColor = null;
        let selectedSize = null;

        const sizeSelect = document.getElementById('size-select');
        sizeSelect.style.display = 'none';

        function selectColor(colorId) {
            selectedColor = colorId;
            checkAndUpdateSizeOptions();
            
        }

        function selectSize(sizeId) {
            selectedSize = sizeId;
            checkAndUpdateQuantityDisplay();
        }

        function checkAndUpdateSizeOptions() {
            if (selectedColor !== null) {
                // Color is selected, so fetch and update available sizes
                updateSizeOptions(selectedColor);
            } else {
                // Color is not selected, so disable size options
                disableSizeOptions();
            }
        }

        function updateSizeOptions(colorId) {
            // Make a POST request to your Laravel route to fetch available sizes based on the selected color
            axios.post(`/products/variant/sizes`, {
                colorId: colorId
            })
            .then(response => {
                const sizeSelect = document.getElementById('size-select');
                sizeSelect.style.display = 'block';

                sizeSelect.innerHTML = ''; // Clear the existing options

                if (response.data.sizes.length > 0) {
                    // Enable and populate size options
                    response.data.sizes.forEach(size => {
                        const option = document.createElement('option');
                        option.value = size.id;
                        option.text = size.name;
                        sizeSelect.appendChild(option);
                    });
                    sizeSelect.disabled = false; // Enable the size select element
                } else {
                    // No sizes available for the selected color, so disable size options
                    disableSizeOptions();
                }
            })
            .catch(error => {
                console.error('Error fetching available sizes:', error);
            });
        }

        function disableSizeOptions() {
            const sizeSelect = document.getElementById('size-select');
            sizeSelect.innerHTML = ''; // Clear the existing options
            sizeSelect.disabled = true; // Disable the size select element
        }
        
        function checkAndUpdateQuantityDisplay() {
            if (selectedColor !== null && selectedSize !== null) {
                // Both color and size are selected, so fetch and display the quantity
                updateQuantityDisplay(selectedColor, selectedSize);
            } else {
                // At least one of color or size is not selected, so display a message
                const quantityDisplay = document.getElementById('quantity-display');
                quantityDisplay.innerHTML = `
                    <h2 class="text-xl font-semibold">Available Quantity</h2>
                    <p>Select both color and size to see available quantity.</p>
                `;
            }
        }

        function updateQuantityDisplay(colorId, sizeId) {
            // For now, we will just log the selected color and size IDs
            console.log('Selected Color Variant ID:', colorId);
            console.log('Selected Size Variant ID:', sizeId);
            
            // Make a POST request to your Laravel route to fetch the quantity
            axios.post(`/products/variant/quantity`, {
                colorId: colorId,
                sizeId: sizeId
            })
            .then(response => {
                const quantityDisplay = document.getElementById('quantity-display');
                quantityDisplay.innerHTML = `
                    <h2 class="text-xl font-semibold">Available Quantity</h2>
                    <p>Available Quantity: ${response.data.quantity}</p>
                `;
            })
            .catch(error => {
                console.error('Error fetching quantity:', error);
            });
        }
    </script>
@endsection
