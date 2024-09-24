@extends('layouts.app')

@section('content')

<div class="bg-white">
    <div class="pb-8 pt-6 sm:pb-16">
      <nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <ol role="list" class="flex items-center space-x-4">
          <li>
            <div class="flex items-center">
              <a href="{{ route('products.category', $product->category->id) }}" class="mr-4 text-sm font-medium text-gray-900">{{ $product->category->name }}</a>
              <svg viewBox="0 0 6 20" aria-hidden="true" class="h-5 w-auto text-gray-300">
                <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
              </svg>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <a href="{{ route('products.brand', $product->brand->id) }}" class="mr-4 text-sm font-medium text-gray-900">{{ $product->brand->name }}</a>
              <svg viewBox="0 0 6 20" aria-hidden="true" class="h-5 w-auto text-gray-300">
                <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
              </svg>
            </div>
          </li>
          <li class="text-sm">
            <a href="#" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ $product->name }}</a>
          </li>
        </ol>
      </nav>
      <div class="mx-auto mt-4 max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="lg:grid lg:auto-rows-min lg:grid-cols-12 lg:gap-x-8">
          <div class="lg:col-span-5 lg:col-start-8">
            <div class="flex justify-between">
              <h1 class="text-xl font-medium text-gray-900">{{ $product->name }}</h1>
              <p class="text-xl font-medium text-gray-900">${{ $product->price }}</p>
            </div>

            <!-- Reviews -->
            <div class="mt-4">
                <h2 class="sr-only">Reviews</h2>
                <div class="flex items-center">
                  <p class="text-sm text-gray-700">
                    {{ number_format($product->reviews->avg('rating'), 1) }}
                    <span class="sr-only"> out of 5 stars</span>
                  </p>
                  <div class="ml-1 flex items-center">
                    @php
                      $averageRating = $product->reviews->avg('rating');
                      $fullStars = floor($averageRating);
                      $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                      $emptyStars = 5 - $fullStars - $halfStar;
                    @endphp

                    @for($i = 0; $i < $fullStars; $i++)
                      <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27l5.18 3.43-1.39-6.06L22 9.24l-6.16-.53L12 2 8.16 8.71 2 9.24l4.21 4.4-1.39 6.06L12 17.27z"/>
                      </svg>
                    @endfor

                    @if($halfStar)
                      <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <defs>
                          <mask id="half-mask">
                            <rect x="0" y="0" width="100%" height="100%" fill="white"/>
                            <rect x="50%" y="0" width="50%" height="100%" fill="black"/>
                          </mask>
                        </defs>
                        <path d="M12 17.27l5.18 3.43-1.39-6.06L22 9.24l-6.16-.53L12 2 8.16 8.71 2 9.24l4.21 4.4-1.39 6.06L12 17.27z" mask="url(#half-mask)" />
                      </svg>
                    @endif

                    @for($i = 0; $i < $emptyStars; $i++)
                      <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27l5.18 3.43-1.39-6.06L22 9.24l-6.16-.53L12 2 8.16 8.71 2 9.24l4.21 4.4-1.39 6.06L12 17.27z"/>
                      </svg>
                    @endfor
                  </div>
                  <div aria-hidden="true" class="ml-4 text-sm text-gray-300">·</div>
                  <div class="ml-4 flex">
                    <button type="button" id="seeAllReviewsBtn" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                      See all {{ $product->reviews->count() }} reviews
                    </button>
                  </div>
                </div>
              </div>
          </div>

          <!-- Image gallery -->
          <div class="mt-8 lg:col-span-7 lg:col-start-1 lg:row-span-3 lg:row-start-1 lg:mt-0">
            <h2 class="sr-only">Images</h2>
            <div class="relative aspect-w-1 aspect-h-1 overflow-hidden">
              <img id="product-image" src="{{ Storage::url($product->main_image) }}" alt="{{ $product->name }}" class="object-cover w-full h-full">
            </div>
          </div>

          <div class="mt-4 lg:col-span-5">
            <form id="add-to-cart-form" method="POST" action="{{ route('cart.add', ['productId' => $product->id]) }}">
                @csrf
                <input type="hidden" name="color_id" id="color_id" value="">
                <input type="hidden" name="size_id" id="size_id" value="">
                <input type="hidden" name="quantity" id="quantity" value="1"> <!-- Default quantity is 1 -->

                <!-- Color picker -->
                <div>
                    <h2 class="text-sm font-medium text-gray-900">Color</h2>
                    @if (!empty($uniqueColors))
                    <div class="mt-4 flex items-center space-x-3">
                        @foreach ($uniqueColors as $colorId)
                            @php
                                $colorVariant = $product->variants->where('color_id', $colorId)->first();
                            @endphp
                            @if ($colorVariant)
                                <button type="button" class="color-button h-8 w-8 rounded-full border" style="background-color: {{ $colorVariant->color->name }}" onclick="selectColor({{ $colorVariant->color->id }}, this)"></button>
                            @endif
                        @endforeach
                    </div>
                    @else
                        <p class="mt-6 text-sm text-gray-600">No available colors for this product.</p>
                    @endif
                </div>

                <!-- Size picker -->
                <div class="mt-8">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-medium text-gray-900">Size</h2>
                    </div>
                    <fieldset aria-label="Choose a size" class="mt-2" id="size-fieldset">
                        <div class="grid grid-cols-3 gap-3 sm:grid-cols-7" id="size-options">
                            <!-- Sizes will be dynamically populated here -->
                        </div>
                    </fieldset>

                    <!-- Available Quantity -->
                    <div class="mt-6" id="quantity-display">
                        <h2 class="text-lg font-medium text-gray-900">Available Quantity</h2>
                        <p class="text-sm text-gray-600">Select both color and size to see available quantity.</p>
                    </div>
                </div>

                <!-- Quantity input -->
                <div class="mt-8">
                    <label for="product-quantity" class="text-sm font-medium text-gray-900">Quantity</label>
                    <input type="number" id="product-quantity" name="quantity" value="1" min="1" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" onchange="updateQuantity(this.value)">
                </div>

                @auth
                <button id="add-to-cart-btn" type="submit" onclick="addToCart()" class="mt-4 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700">Add to cart</button>
                @else
                <button id="add-to-cart-btn" type="button" onclick="showLoginError()" class="mt-4 flex w-full items-center justify-center rounded-md border border-transparent bg-gray-300 px-8 py-3 text-base font-medium text-white cursor-not-allowed">Add to cart</button>
                @endauth

            </form>

            <!--Error to show-->
            <div id="login-error" class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md text-center hidden">
                <span class="font-semibold">Error:</span> Please <a href="{{ route('login') }}" class="underline font-medium hover:text-red-600">log in</a> to add items to your cart.
            </div>

            <!--Error to show-->
            <div id="quantity-error" class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md text-center hidden">
                <span class="font-semibold">Error:</span> Only <span id="available-quantity"></span> product(s) available.
            </div>

            <!-- Product details -->
            <div class="mt-8">
              <h2 class="text-sm font-medium text-gray-900">Description</h2>
              <div class="prose prose-sm mt-4 text-gray-500">
                <p>{{ $product->description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@include('modals.reviews-modal')
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let selectedColor = null;
    let selectedSize = null;
    let availableQuantity = 0;

    const sizeContainer = document.getElementById('size-options');
    const quantityDisplay = document.getElementById('quantity-display');
    const addToCartButton = document.getElementById('add-to-cart-btn');
    const quantityErrorMessage = document.getElementById('quantity-error');
    const loginErrorMessage = document.getElementById('login-error');

    sizeContainer.style.display = 'none'; // Hide size options initially
    addToCartButton.disabled = true; // Disable the button by default
    addToCartButton.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
    addToCartButton.classList.add('bg-gray-300', 'cursor-not-allowed');

    function selectColor(colorId, buttonElement) {
        event.preventDefault(); // Pass event as an argument

        selectedColor = colorId;
        selectedSize = null;
        sizeContainer.innerHTML = '';
        sizeContainer.style.display = 'none';
        checkAndUpdateSizeOptions();

        document.querySelectorAll('.color-button').forEach(btn => {
            btn.classList.remove('ring', 'ring-indigo-500');
        });
        buttonElement.classList.add('ring', 'ring-indigo-500');

        // Update the hidden input field for color
        document.getElementById('color_id').value = colorId;

        quantityDisplay.innerHTML = `
            <h2 class="text-xl font-semibold">Available Quantity</h2>
            <p>Select both color and size to see available quantity.</p>
        `;

        checkAndUpdateAddToCartButton();
    }

    function selectSize(sizeId, buttonElement) {
        event.preventDefault(); // Pass event as an argument

        selectedSize = sizeId;
        checkAndUpdateQuantityDisplay();
        checkAndUpdateAddToCartButton();

        document.querySelectorAll('#size-options button').forEach(btn => {
            btn.classList.remove('bg-indigo-500', 'text-white', 'border-indigo-500', 'ring-2', 'ring-indigo-500');
            btn.style.backgroundColor = '';
            btn.style.borderColor = '';
            btn.style.color = '';
            btn.style.boxShadow = '';
            btn.style.outline = '';
            btn.style.outlineOffset = '';
        });
        buttonElement.style.backgroundColor = 'rgb(79, 70, 229)';
        buttonElement.style.color = 'white';
        buttonElement.style.borderColor = 'rgb(79, 70, 229)';
        buttonElement.style.outline = '2px solid rgb(79, 70, 229)';
        buttonElement.style.outlineOffset = '2px';

        // Update the hidden input field for size
        document.getElementById('size_id').value = sizeId;

        checkAndUpdateQuantityDisplay();
        checkAndUpdateAddToCartButton();
    }

    function checkAndUpdateAddToCartButton() {
        if (selectedColor !== null && selectedSize !== null) {
            addToCartButton.disabled = false; // Enable button
            addToCartButton.classList.remove('bg-gray-300', 'cursor-not-allowed');
            addToCartButton.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
        } else {
            addToCartButton.disabled = true; // Disable button
            addToCartButton.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
            addToCartButton.classList.add('bg-gray-300', 'cursor-not-allowed');
        }
    }

    async function addToCart(event) {
        event.preventDefault(); // Prevent the default form submission

        const quantityInput = document.getElementById('product-quantity');

        // Ensure the button is not disabled
        if (!addToCartButton.disabled) {
            const quantity = parseInt(quantityInput.value);

            // Check if color and size are selected
            if (selectedColor === null || selectedSize === null) {
                quantityErrorMessage.style.display = 'block';
                quantityErrorMessage.textContent = 'Please select a color and size.';
                return; // Exit the function if color or size is not selected
            }

            // Check if the entered quantity exceeds the available stock
            if (quantity > availableQuantity) {
                quantityErrorMessage.style.display = 'block';
                quantityErrorMessage.textContent = `Only ${availableQuantity} product(s) available to add.`;
                return; // Exit the function without submitting the form
            }

            // Hide error message and proceed to submit the form only if the quantity is valid
            quantityErrorMessage.style.display = 'none';
            document.getElementById('add-to-cart-form').submit(); // Submit the form only if the quantity is correct
        }
    }

    function showLoginError() {
        loginErrorMessage.style.display = 'block';
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
        axios.post('/products/variant/sizes', {
            productId: {{ $product->id }}, // Pass the product ID
            colorId: colorId
        })
        .then(response => {
            console.log('Sizes response:', response.data); // Debug log

            if (response.data.sizes && response.data.sizes.length > 0) {
                sizeContainer.style.display = 'grid'; // Show size options

                response.data.sizes.forEach(size => {
                    const sizeButton = document.createElement('button');
                    sizeButton.className = 'px-3 py-1 border rounded text-sm font-medium text-gray-900 hover:bg-gray-200 flex items-center justify-center overflow-hidden';
                    sizeButton.textContent = size.name;
                    sizeButton.onclick = (event) => selectSize(size.id, event.target); // Add event listener with reference to the button
                    sizeContainer.appendChild(sizeButton);
                });
            } else {
                disableSizeOptions();
            }
        })
        .catch(error => {
            console.error('Error fetching available sizes:', error);
            disableSizeOptions();
        });
    }

    function disableSizeOptions() {
        sizeContainer.innerHTML = '<p class="text-sm text-gray-600">No available sizes for the selected color.</p>';
        sizeContainer.style.display = 'none'; // Hide size options
    }

    function checkAndUpdateQuantityDisplay() {
        if (selectedColor !== null && selectedSize !== null) {
            // Both color and size are selected, so fetch and display the quantity
            updateQuantityDisplay(selectedColor, selectedSize);
        } else {
            // At least one of color or size is not selected, so display a message
            quantityDisplay.innerHTML = `
                <h2 class="text-xl font-semibold">Available Quantity</h2>
                <p>Select both color and size to see available quantity.</p>
            `;
        }
    }

    function updateQuantityDisplay(colorId, sizeId) {
        axios.post('/products/variant/quantity', {
            colorId: colorId,
            sizeId: sizeId
        })
        .then(response => {
            console.log('Quantity response:', response.data);

            availableQuantity = response.data.quantity;
            const quantityInput = document.getElementById('product-quantity');
            quantityInput.max = availableQuantity; // Set the maximum allowed quantity

            quantityDisplay.innerHTML = `
                <h2 class="text-xl font-semibold">Available Quantity</h2>
                <p>Available Quantity: ${availableQuantity}</p>
            `;
        })
        .catch(error => {
            console.error('Error fetching quantity:', error);
            quantityDisplay.innerHTML = `
                <h2 class="text-xl font-semibold">Available Quantity</h2>
                <p>Error fetching quantity information.</p>
            `;
        });
    }

    function updateQuantity(value) {
        const quantityInput = document.getElementById('product-quantity');
        // Only show an error message if the value exceeds available quantity
        if (value > availableQuantity) {
            quantityErrorMessage.style.display = 'block';
            quantityErrorMessage.textContent = `Only ${availableQuantity} product(s) available.`;
        } else {
            quantityErrorMessage.style.display = 'none';
        }
    }

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Open the modal
    $('#seeAllReviewsBtn').click(function() {
      $('#reviewsModal').removeClass('hidden');
      $('body').addClass('overflow-hidden'); // Disable scrolling on the body
    });

    // Close the modal
    $('#closeModal, #closeModalFooter').click(function() {
      $('#reviewsModal').addClass('hidden');
      $('body').removeClass('overflow-hidden'); // Enable scrolling on the body
    });

    // Close the modal when clicking outside of it
    $(window).click(function(event) {
      if ($(event.target).is('#reviewsModal')) {
        $('#reviewsModal').addClass('hidden');
        $('body').removeClass('overflow-hidden'); // Enable scrolling on the body
      }
    });
  });
</script>
@endsection
