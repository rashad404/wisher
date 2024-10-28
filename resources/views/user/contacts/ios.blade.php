<!-- Redesigned iOS Contact Import Guide Modal with Tailwind CSS -->
<div id="iosImportGuideModal" class="fixed z-10 inset-0 hidden bg-gray-600 bg-opacity-75 flex items-center justify-center" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Modal Content -->
    <div class="relative bg-white rounded-lg shadow-xl transform transition-all max-w-lg w-full p-6">
        <!-- Icon and Title -->
        <div class="flex flex-col items-center justify-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-semibold leading-6 text-gray-900" id="modal-title">How to Import Contacts from iPhone</h3>
        </div>

        <!-- Instructions List -->
        <div class="mt-4 text-left">
            <ol class="list-decimal list-inside text-sm text-gray-600 space-y-2">
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

        <!-- File Upload Form -->
        <form action="{{ route('contacts.import.ios') }}" method="POST" enctype="multipart/form-data" class="mt-5 sm:mt-6">
            @csrf
            <!-- File Input -->
            <div class="mb-4">
                <input type="file" id="contacts_file" name="contacts_file" accept=".vcf" required class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <!-- Buttons for Submit and Cancel -->
            <div class="sm:flex sm:justify-between sm:space-x-4">
                <button type="submit" class="inline-flex w-full sm:w-auto justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Import iOS Contacts
                </button>
                <button type="button" id="closeIosImportGuide" class="mt-3 inline-flex w-full sm:w-auto justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 sm:mt-0">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
    // iOS Contact Import Guide Modal Toggle
    const showIosImportGuideBtn = document.getElementById('showIosImportGuide');
    const iosImportGuideModal = document.getElementById('iosImportGuideModal');
    const closeIosImportGuideBtn = document.getElementById('closeIosImportGuide');

    // Show Modal
    showIosImportGuideBtn.addEventListener('click', () => {
        iosImportGuideModal.classList.remove('hidden');
    });

    // Close Modal
    closeIosImportGuideBtn.addEventListener('click', () => {
        iosImportGuideModal.classList.add('hidden');
    });

    // Close modal by clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === iosImportGuideModal) {
            iosImportGuideModal.classList.add('hidden');
        }
    });

    // Close modal with Escape key
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !iosImportGuideModal.classList.contains('hidden')) {
            iosImportGuideModal.classList.add('hidden');
        }
    });
</script>
