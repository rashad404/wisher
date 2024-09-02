
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

<script>

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
</script>