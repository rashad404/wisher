<div id="reviewsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex items-center justify-center overflow-y-auto">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl mx-4 relative max-h-[80vh]">
      <div class="flex items-center justify-between p-4 border-b">
        <h5 class="text-lg font-semibold">Product Reviews</h5>
        <button type="button" id="closeModal" class="text-gray-500 hover:text-gray-700">
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <div class="p-4 overflow-y-auto" style="max-height: calc(80vh - 4rem);">
        @if($product->reviews->isEmpty())
          <p>No reviews yet.</p>
        @else
          <ul class="space-y-2">
            @foreach($product->reviews as $review)
              <li class="border p-4 rounded bg-gray-50">
                <div class="flex items-center mb-2">
                  <strong class="mr-2">{{ $review->user->name }}:</strong>
                  <div class="flex items-center">
                    @for($i = 0; $i < 5; $i++)
                      <svg class="w-4 h-4 {{ $i < $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27l5.18 3.43-1.39-6.06L22 9.24l-6.16-.53L12 2 8.16 8.71 2 9.24l4.21 4.4-1.39 6.06L12 17.27z"/>
                      </svg>
                    @endfor
                  </div>
                </div>
                <p class="mb-2">{{ $review->review }}</p>
                <span class="text-sm text-gray-500">{{ $review->created_at->format('Y-m-d H:i') }}</span>
              </li>
            @endforeach
          </ul>
        @endif
      </div>
      <div class="p-4 border-t">
        <button type="button" id="closeModalFooter" class="bg-gray-200 text-gray-700 py-2 px-4 rounded hover:bg-gray-300">
          Close
        </button>
      </div>
    </div>
  </div>
