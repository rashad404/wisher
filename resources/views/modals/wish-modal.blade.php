<div id="eventModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full h-auto max-h-screen p-6 border border-gray-300 overflow-auto">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900">Select Event</h3>
            <button type="button" id="closeEventModal" class="text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="eventForm" class="mt-4">
            @csrf
            <div>
                <label for="event-category" class="block text-sm font-semibold text-gray-900">Event Category</label>
                <select id="event-category" name="event_category" class="w-full border border-gray-300 rounded-md p-2 text-gray-900" required>
                    <option value="">Select Event Category</option>
                    @foreach($eventCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label for="event" class="block text-sm font-semibold text-gray-900">Event</label>
                <select id="event" name="event" class="w-full border border-gray-300 rounded-md p-2 text-gray-900" required disabled>
                    <option value="">Select Event</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label for="lang" class="block text-sm font-semibold text-gray-900">Language</label>
                <select id="languageDropdown" name="language" class="w-full border border-gray-300 rounded-md p-2 text-gray-900" required disabled>
                    <option value="">Select Language</option>
                    @foreach($languages as $language)
                        <option value="{{ $language->lang }}">{{ $language->lang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label for="message" class="block text-sm font-semibold text-gray-900">Message</label>
                <select id="message" name="message" class="w-full border border-gray-300 rounded-md p-2 text-gray-900" required disabled>
                    <option value="">Select Message</option>
                    @foreach($wishes as $wish)
                        <option value="{{ $wish->id }}">{{ $wish->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4 flex justify-end gap-4">
                <button type="button" id="submitEventForm" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                    Okay
                </button>
                <button type="button" id="closeEventModalButton" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Enable Event dropdown when Event Category is selected
    document.getElementById('event-category').addEventListener('change', function() {
        const eventDropdown = document.getElementById('event');
        eventDropdown.disabled = !this.value;  // Enable if a category is selected
        if (!this.value) {
            eventDropdown.value = ""; // Reset the event dropdown value if category is cleared
            document.getElementById('languageDropdown').disabled = true; // Disable Language dropdown
            document.getElementById('message').disabled = true; // Disable Message dropdown
        }
    });

    // Enable Language dropdown when Event is selected
    document.getElementById('event').addEventListener('change', function() {
        const languageDropdown = document.getElementById('languageDropdown');
        languageDropdown.disabled = !this.value; // Enable if an event is selected
        if (!this.value) {
            languageDropdown.value = ""; // Reset the language dropdown value if event is cleared
            document.getElementById('message').disabled = true; // Disable Message dropdown
        }
    });

    // Enable Message dropdown when Language is selected
    document.getElementById('languageDropdown').addEventListener('change', function() {
        const messageDropdown = document.getElementById('message');
        messageDropdown.disabled = !this.value; // Enable if a language is selected
        if (!this.value) {
            messageDropdown.value = ""; // Reset the message dropdown value if language is cleared
        }
    });
</script>
