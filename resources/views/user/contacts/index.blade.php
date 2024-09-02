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
            <a href="{{ route('user.contacts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
                <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Search by name, phone, or email" type="search" value="{{ request('search') }}">
            </div>
        </form>
    </div>

    <!-- Contacts list -->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            @forelse($contacts as $contact)
                <li>
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
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
                                    <div class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
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
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                                <div class="text-sm text-gray-500">
                                    @if($contact->groups->isEmpty())
                                        -
                                    @else
                                        {{ $contact->groups->pluck('name')->join(', ') }}
                                    @endif
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('user.contacts.edit', $contact->id) }}" class="text-indigo-600 hover:text-indigo-900">
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

<!-- iOS Contact Import Guide Modal -->
<div id="iosImportGuideModal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
          <div>
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
              <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-5">
              <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">How to Import Contacts from iPhone</h3>
              <div class="mt-2">
                <ol class="list-decimal list-inside text-sm text-gray-500 text-left space-y-2">
                  <li>On your iPhone, go to Settings > [Your Name] > iCloud</li>
                  <li>Turn on Contacts if it's not already on</li>
                  <li>Open icloud.com on your computer and sign in</li>
                  <li>Click on Contacts</li>
                  <li>Select the contacts you want to export</li>
                  <li>Click the gear icon and choose "Export vCard"</li>
                  <li>Save the .vcf file to your computer</li>
                  <li>Click the "Choose File" button below and select the saved .vcf file</li>
                </ol>
              </div>
            </div>
          </div>
          <form action="{{ route('contacts.import.ios') }}" method="POST" enctype="multipart/form-data" class="mt-5 sm:mt-6">
            @csrf
            <div class="mb-4">
              <input type="file" id="contacts_file" name="contacts_file" accept=".vcf" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <div class="sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
              <button type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:col-start-2">Import iOS Contacts</button>
              <button type="button" id="closeIosImportGuide" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Android Contact Import Guide Modal -->
  <div id="androidImportGuideModal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
          <div>
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
              <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-5">
              <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">How to Import Contacts from Android</h3>
              <div class="mt-2">
                <ol class="list-decimal list-inside text-sm text-gray-500 text-left space-y-2">
                  <li>On your Android device, go to Contacts app</li>
                  <li>Tap the menu icon (three dots) and select "Manage contacts"</li>
                  <li>Choose "Export contacts"</li>
                  <li>Select "Export to .vcf file"</li>
                  <li>Choose where to save the file (e.g., Google Drive)</li>
                  <li>On your computer, download the .vcf file</li>
                  <li>Click the "Choose File" button below and select the downloaded .vcf file</li>
                </ol>
              </div>
            </div>
          </div>
          <form action="{{ route('contacts.import.android') }}" method="POST" enctype="multipart/form-data" class="mt-5 sm:mt-6">
            @csrf
            <div class="mb-4">
              <input type="file" name="contacts_file" accept=".vcf" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
            </div>
            <div class="sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
              <button type="submit" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 sm:col-start-2">Import Android Contacts</button>
              <button type="button" id="closeAndroidImportGuide" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    

    </div>

<!-- Add JavaScript at the bottom of the blade file -->
<script>
    // iOS Contact Import Guide Modal
    const showIosImportGuideBtn = document.getElementById('showIosImportGuide');
    const iosImportGuideModal = document.getElementById('iosImportGuideModal');
    const closeIosImportGuideBtn = document.getElementById('closeIosImportGuide');

    showIosImportGuideBtn.addEventListener('click', () => {
        iosImportGuideModal.classList.remove('hidden');
    });

    closeIosImportGuideBtn.addEventListener('click', () => {
        iosImportGuideModal.classList.add('hidden');
    });

    // Close iOS modal when clicking outside
    iosImportGuideModal.addEventListener('click', (e) => {
        if (e.target === iosImportGuideModal) {
            iosImportGuideModal.classList.add('hidden');
        }
    });

    // Android Contact Import Guide Modal
    const showAndroidImportGuideBtn = document.getElementById('showAndroidImportGuide');
    const androidImportGuideModal = document.getElementById('androidImportGuideModal');
    const closeAndroidImportGuideBtn = document.getElementById('closeAndroidImportGuide');

    showAndroidImportGuideBtn.addEventListener('click', () => {
        androidImportGuideModal.classList.remove('hidden');
    });

    closeAndroidImportGuideBtn.addEventListener('click', () => {
        androidImportGuideModal.classList.add('hidden');
    });

    // Close Android modal when clicking outside
    androidImportGuideModal.addEventListener('click', (e) => {
        if (e.target === androidImportGuideModal) {
            androidImportGuideModal.classList.add('hidden');
        }
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