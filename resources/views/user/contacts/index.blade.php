@extends('layouts.user.app')

@section('content')
<x-resource-index
    :title="'Əlaqələrim'"
    :subtitle="'Əlaqə siyahınız'"
    :createRoute="route('user.contacts.create')"
    :bulkDeleteRoute="route('user.contacts.bulk-delete')"
    :bulkStatusUpdateRoute="route('user.contacts.bulk-status-update')"
    :searchRoute="route('user.contacts.index')"
    :items="$contacts"
>
    <x-slot name="breadcrumbs">
        <x-breadcrumbs :links="[
            ['url' => route('user.index'), 'label' => 'Home'],
            ['url' => route('user.contacts.index'), 'label' => 'Contacts'],
        ]"/>
    </x-slot>

    <x-slot name="actions">
        <div class="flex action-buttons space-x-2">
            <!-- Main Add Button (primary) with orange color (#E9654B) and focus:ring for orange outline -->
            <a href="{{ route('user.contacts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#E9654B] hover:bg-[#d14836] focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 active:bg-[#c13826] transition-all duration-300">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Əlavə et
            </a>

            <!-- iPhone Import Button (secondary, outlined) -->
            <button id="showIosImportGuide" class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 rounded-md shadow-sm text-sm font-medium bg-white hover:bg-blue-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 action-button transition duration-300">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                iPhone Import
            </button>

            <!-- Android Import Button (secondary, outlined) -->
            <button id="showAndroidImportGuide" class="inline-flex items-center px-4 py-2 border border-green-600 text-green-600 rounded-md shadow-sm text-sm font-medium bg-white hover:bg-green-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 action-button transition duration-300">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3h6m-6 8h6m-6 4h6m-6 4h6m4-4v4m0 0l-4-4m4 4l4-4" />
                </svg>
                Android Import
            </button>
        </div>
    </x-slot>

    <!-- Filter by Status -->
    <div class="mb-4">
        <select name="status" id="statusFilter" onchange="this.form.submit()" class="form-select">
            <option value="">All Contacts</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <!-- Search Input with New Placeholder -->
    <input type="text" class="form-input" placeholder="Search contacts by name, email, or phone" name="search" value="{{ request('search') }}">

    <x-slot name="list">
        @forelse($contacts as $contact)
            <li class="hover:bg-gray-50 transition duration-300 ease-in-out">
                <div class="px-4 py-4 sm:px-6 flex items-center">
                    <div class="flex-shrink-0 mr-4">
                        <input type="checkbox" name="selected_contacts[]" value="{{ $contact->id }}" class="resource-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
                                <div class="text-sm font-medium text-indigo-600 hover:text-indigo-900 transition duration-300">
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
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-50 text-green-700">
                                    Active
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-50 text-red-700">
                                    InActive
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
                                <!-- Edit Button with Tooltip -->
                                <a href="{{ route('user.contacts.edit', $contact->id) }}" class="text-gray-500 hover:text-gray-700" title="Edit Contact">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <!-- Delete Button with Tooltip -->
                                <form action="{{ route('user.contacts.destroy', $contact->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete Contact" onclick="return confirm('Silmək istədiyinizə əminsinizmi?')" class="text-red-600 hover:text-red-900">
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
    </x-slot>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $contacts->links() }}
    </div>

</x-resource-index>

@include('user.contacts.ios')
@include('user.contacts.android')
@endsection
