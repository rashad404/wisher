<div class="bg-white p-4 rounded-md shadow h-full">
    <h3 class="text-lg font-semibold mb-4">Filters</h3>
    <!-- Filter Form -->
    <form id="filterForm">
        @csrf

        
        <!-- Category Filter -->
        <div class="mb-6">
            <h4 class="text-md font-semibold mb-2">Category</h4>
            <select name="category" class="w-full border-gray-300 rounded-md">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Subcategory Filter -->
        <div class="mb-6">
            <h4 class="text-md font-semibold mb-2">Subcategory</h4>
            <select name="subcategory" class="w-full border-gray-300 rounded-md">
                <option value="">Select Subcategory</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Color Filter -->
        <div class="mb-6">
            <h4 class="text-md font-semibold mb-2">Color</h4>
            <select name="color" class="w-full border-gray-300 rounded-md">
                <option value="">Select Color</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Size Filter -->
        <div class="mb-6">
            <h4 class="text-md font-semibold mb-2">Size</h4>
            <select name="size" class="w-full border-gray-300 rounded-md">
                <option value="">Select Size</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Brand Filter -->
        <div class="mb-6">
            <h4 class="text-md font-semibold mb-2">Brand</h4>
            <select name="brand" class="w-full border-gray-300 rounded-md">
                <option value="">Select Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Apply Filters Button -->
        <div class="mb-6">
            <button type="button" class="w-full bg-blue-500 text-white py-2 rounded-md" onclick="applyFilters()">Apply Filters</button>
        </div>
    </form>
</div>

<script>
    function applyFilters() {
        const filterForm = document.getElementById('filterForm');
        const formData = new FormData(filterForm);

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
                    const productCard = `
                        <div class="product-card bg-white group relative border-b border-r border-gray-200 p-4 sm:p-6 m-1">
                            <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200 group-hover:opacity-75">
                                <img
                                    src="{{ asset('storage/') }}/${product.main_image}"
                                    alt="${product.name}"
                                    class="h-full w-full object-cover object-center"
                                >
                            </div>
                            <div class="pb-4 pt-10 text-center">
                                <h3 class="text-sm font-medium text-gray-900">
                                    <a href="/products/${product.id}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        ${product.name}
                                    </a>
                                </h3>
                                <p class="mt-4 text-base font-medium text-gray-900">$${product.price}</p>
                            </div>
                        </div>
                    `;
                    productsGrid.insertAdjacentHTML('beforeend', productCard);
                });
            } else {
                console.error('No products found or response is invalid:', data);
            }
        })
        .catch(error => console.error('Error fetching products:', error));
    }
</script>
