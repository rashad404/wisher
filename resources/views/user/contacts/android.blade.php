<!-- Redesigned Android Contact Import Guide Modal -->
<div id="androidImportGuideModal" class="fixed z-10 inset-0 hidden bg-gray-600 bg-opacity-75 flex items-center justify-center" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Modal Content -->
    <div class="relative bg-white rounded-lg shadow-xl transform transition-all max-w-lg w-full p-6">
        <!-- Icon and Title -->
        <div class="flex flex-col items-center justify-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-semibold leading-6 text-gray-900" id="modal-title">How to Import Contacts from Android</h3>
        </div>

        <!-- Instructions List -->
        <div class="mt-4 text-left">
            <ol class="list-decimal list-inside text-sm text-gray-600 space-y-2">
                <li>On your Android device, go to Contacts app</li>
                <li>Tap the menu icon (three dots) and select "Manage contacts"</li>
                <li>Choose "Export contacts"</li>
                <li>Select "Export to .vcf file"</li>
                <li>Choose where to save the file (e.g., Google Drive)</li>
                <li>On your computer, download the .vcf file</li>
                <li>Click the "Choose File" button below and select the downloaded .vcf file</li>
            </ol>
        </div>

        <!-- File Upload Form -->
        <form action="{{ route('contacts.import.android') }}" method="POST" enctype="multipart/form-data" class="mt-5 sm:mt-6">
            @csrf
            <!-- File Input -->
            <div class="mb-4">
                <input type="file" name="contacts_file" accept=".vcf" required class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-100 file:text-green-700 hover:file:bg-green-200 focus:file:ring-2 focus:file:ring-green-400 transition">
            </div>

            <!-- Buttons for Submit and Cancel -->
            <div class="sm:flex sm:justify-between sm:space-x-4">
                <button type="submit" class="inline-flex w-full sm:w-auto justify-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Import Android Contacts
                </button>
                <button type="button" id="closeAndroidImportGuide" class="mt-3 inline-flex w-full sm:w-auto justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 sm:mt-0">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
    // Android Contact Import Guide Modal Toggle
    const showAndroidImportGuideBtn = document.getElementById('showAndroidImportGuide');
    const androidImportGuideModal = document.getElementById('androidImportGuideModal');
    const closeAndroidImportGuideBtn = document.getElementById('closeAndroidImportGuide');

    // Show Modal
    showAndroidImportGuideBtn.addEventListener('click', () => {
        androidImportGuideModal.classList.remove('hidden');
    });

    // Close Modal
    closeAndroidImportGuideBtn.addEventListener('click', () => {
        androidImportGuideModal.classList.add('hidden');
    });

    // Close modal by clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === androidImportGuideModal) {
            androidImportGuideModal.classList.add('hidden');
        }
    });

    // Close modal with Escape key
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !androidImportGuideModal.classList.contains('hidden')) {
            androidImportGuideModal.classList.add('hidden');
        }
    });
</script>
