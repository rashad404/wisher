
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
</div>

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
</script>