<div id="eventModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <!-- Modal Container -->
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full h-auto max-h-screen p-6 border border-gray-300 overflow-auto">
        <!-- Modal Header -->
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900">Select Event</h3>
            <button type="button" id="closeEventModal" class="text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Modal Body -->
        <form id="eventForm" class="mt-4">
            @csrf
            <!-- Event Category -->
            <div>
                <label for="event-category" class="block text-sm font-semibold text-gray-900">Event Category</label>
                <select id="event-category" name="event_category" class="w-full border border-gray-300 rounded-md p-2 text-gray-900" required>
                    <option value="">Select Event Category</option>
                    @foreach($eventCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Event -->
            <div class="mt-4">
                <label for="event" class="block text-sm font-semibold text-gray-900">Event</label>
                <select id="event" name="event" class="w-full border border-gray-300 rounded-md p-2 text-gray-900" required>
                    <option value="">Select Event</option>
                </select>
            </div>
            <!-- Message Selection -->
            <div class="mt-4">
                <label for="message" class="block text-sm font-semibold text-gray-900">Message</label>
                <select id="message" name="message" class="w-full border border-gray-300 rounded-md p-2 text-gray-900" required>
                    <option value="">Select Message</option>
                </select>
            </div>
            <div class="mt-4 flex justify-end gap-4">
                <button type="button" id="submitEventForm" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                    Okey
                </button>
                <button type="button" id="closeEventModalButton" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
