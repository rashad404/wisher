<!-- resources/views/components/resource-index.blade.php -->
@props([
    'title',
    'subtitle',
    'createRoute',
    'bulkDeleteRoute',
    'bulkStatusUpdateRoute',
    'searchRoute',
    'items',
])

<div class="min-h-screen">
    <!-- Breadcrumbs -->
    <div class="mb-6">
        {{ $breadcrumbs ?? '' }}
    </div>

    <!-- Page header -->
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                {{ $title }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                {{ $subtitle }}
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4 space-x-2">
            {{ $actions ?? '' }}
        </div>
    </div>

    <!-- Search form -->
    <div class="max-w-lg w-full lg:max-w-xs mb-6">
        <form action="{{ $searchRoute }}" method="GET">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Search" type="search" value="{{ request('search') }}">
            </div>
        </form>
    </div>

    <!-- Items list -->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-4 sm:px-6 flex items-center justify-between bg-gray-50">
            <div>
                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <label for="select-all" class="ml-2 text-sm text-gray-700">Select All</label>
            </div>
            <div>
                <button id="delete-selected" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm mr-2" disabled>Delete Selected</button>
                <select id="change-status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" disabled>
                    <option value="">Change Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <ul class="divide-y divide-gray-200">
            {{ $list }}
        </ul>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $items->links('vendor.pagination.custom') }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const itemCheckboxes = document.querySelectorAll('.resource-checkbox');
        
        const deleteSelectedButton = document.getElementById('delete-selected');
        const changeStatusSelect = document.getElementById('change-status');

        function updateActionButtons() {
            const selectedCount = document.querySelectorAll('.resource-checkbox:checked').length;
            deleteSelectedButton.disabled = selectedCount === 0;
            changeStatusSelect.disabled = selectedCount === 0;
            
        }

        selectAllCheckbox.addEventListener('change', function() {
            
            itemCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
            updateActionButtons();
        });

        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateActionButtons);
        });

        deleteSelectedButton.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete the selected items?')) {
                const selectedItems = Array.from(document.querySelectorAll('.resource-checkbox:checked')).map(checkbox => checkbox.value);
                fetch('{{ $bulkDeleteRoute }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: selectedItems })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('An error occurred while deleting items');
                    }
                });
            }
        });

        changeStatusSelect.addEventListener('change', function() {
            const selectedItems = Array.from(document.querySelectorAll('.resource-checkbox:checked')).map(checkbox => checkbox.value);
            const newStatus = this.value;
            if (newStatus && selectedItems.length > 0) {
                fetch('{{ $bulkStatusUpdateRoute }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: selectedItems, status: newStatus })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('An error occurred while updating item status');
                    }
                });
            }
        });
    });
</script>