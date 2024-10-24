@extends('layouts.user.app')

@section('content')
<div class="min-h-screen">
    <!-- Breadcrumbs -->
    <div class="mb-6">
        <x-breadcrumbs :links="[
            ['url' => route('user.index'), 'label' => 'Home'],
            ['url' => route('user.contacts.index'), 'label' => 'Contacts'],
        ]"/>
    </div>

    <!-- Page header -->
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Əlaqələrim
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Əlaqə siyahınız
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4 space-x-2">
            <a href="{{ route('user.contacts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#E9654B] hover:bg-[#d45a43] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E9654B]">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Əlavə et
            </a>
            <button id="showIosImportGuide" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                iPhone Import
            </button>
            <button id="showAndroidImportGuide" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3h6m-6 8h6m-6 4h6m-6 4h6m4-4v4m0 0l-4-4m4 4l4-4" />
                </svg>
                Android Import
            </button>
        </div>
    </div>

    <!-- Search form -->
    <div class="max-w-lg w-full lg:max-w-xs mb-6">
        <form action="{{ route('user.contacts.index') }}" method="GET">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#E9654B] focus:border-[#E9654B] sm:text-sm" placeholder="Search by name, phone, or email" type="search" value="{{ request('search') }}">
            </div>
        </form>
    </div>

    <!-- Contacts list -->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-4 sm:px-6 flex items-center justify-between bg-gray-50">
            <div>
                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <label for="select-all" class="ml-2 text-sm text-gray-700">Select All</label>
            </div>
            <div>
                <button id="delete-selected" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm mr-2 hover:bg-red-600 transition duration-300 ease-in-out" disabled>Delete Selected</button>
                <select id="change-status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" disabled>
                    <option value="">Change Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <ul class="divide-y divide-gray-200">
            @forelse($contacts as $contact)
                <li class="hover:bg-gray-50">
                    <div class="px-4 py-4 sm:px-6 flex items-center">
                        <div class="flex-shrink-0 mr-4">
                            <input type="checkbox" name="selected_contacts[]" value="{{ $contact->id }}" class="contact-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="flex-grow flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($contact->photo)
                                        <img class="h-12 w-12 rounded-full" src="{{ Storage::url($contact->photo) }}" alt="{{ $contact->name }}">
                                    @else
                                        <svg class="h-12 w-12 rounded-full bg-gray-300 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-[#E9654B] hover:text-[#d45a43]">
                                        <a href="{{ route('user.contacts.show', $contact->id) }}">{{ $contact->name }}</a>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $contact->email }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="text-sm text-gray-900 phone-number" data-phone-number="{{ $contact->phone_number }}">
                                    {{ $contact->phone_number }}
                                </div>
                                @if ($contact->status == 1)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif

                                <div class="text-sm text-gray-500">
                                    @if($contact->groups->isEmpty())
                                        -
                                    @else
                                        {{ $contact->groups->pluck('name')->join(', ') }}
                                    @endif
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('user.contacts.edit', $contact->id) }}" class="text-[#E9654B] hover:text-[#d45a43]">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('user.contacts.destroy', $contact->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Silmək istədiyinizə əminsinizmi?')" class="text-red-600 hover:text-red-900">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="px-4 py-4 sm:px-6 text-center text-gray-500">
                    No contacts found.
                </li>
            @endforelse
        </ul>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $contacts->links('vendor.pagination.custom') }}
    </div>
</div>

@include('user.contacts.ios')
@include('user.contacts.android')


<!-- Add JavaScript at the bottom of the blade file -->
<script>
    // Bulk actions
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const contactCheckboxes = document.querySelectorAll('.contact-checkbox');
        const deleteSelectedButton = document.getElementById('delete-selected');
        const changeStatusSelect = document.getElementById('change-status');

        function updateActionButtons() {
            const selectedCount = document.querySelectorAll('.contact-checkbox:checked').length;
            deleteSelectedButton.disabled = selectedCount === 0;
            changeStatusSelect.disabled = selectedCount === 0;
        }

        selectAllCheckbox.addEventListener('change', function() {
            contactCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
            updateActionButtons();
        });

        contactCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateActionButtons);
        });

        deleteSelectedButton.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete the selected contacts?')) {
                const selectedContacts = Array.from(document.querySelectorAll('.contact-checkbox:checked')).map(checkbox => checkbox.value);
                // Send AJAX request to delete contacts
                fetch('{{ route("user.contacts.bulk-delete") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ contacts: selectedContacts })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('An error occurred while deleting contacts');
                    }
                });
            }
        });

        changeStatusSelect.addEventListener('change', function() {
            const selectedContacts = Array.from(document.querySelectorAll('.contact-checkbox:checked')).map(checkbox => checkbox.value);
            const newStatus = this.value;
            if (newStatus && selectedContacts.length > 0) {
                // Send AJAX request to change contact status
                fetch('{{ route("user.contacts.bulk-status-update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ contacts: selectedContacts, status: newStatus })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('An error occurred while updating contact status');
                    }
                });
            }
        });
    });

    // Phone number toggle functionality
    document.getElementById('toggle-phone-numbers').addEventListener('click', function() {
        const phoneNumbers = document.querySelectorAll('.phone-number');
        phoneNumbers.forEach(phone => {
            const actualNumber = phone.getAttribute('data-phone-number');
            if (phone.textContent.trim() === actualNumber) {
                phone.textContent = '(***) ***-***';
            } else {
                phone.textContent = actualNumber;
            }
        });

        // Toggle the button text between "Hide" and "Show"
        this.textContent = this.textContent === 'Hide' ? 'Show' : 'Hide';
    });
</script>

@endsection
