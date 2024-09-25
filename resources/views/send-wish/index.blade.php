@extends('layouts.user.app')

@section('content')

<div class="mb-8">
    <h3 class="text-xl font-bold text-gray-900 mb-4">Send Wish</h3>

    <form action="#" method="POST">
        @csrf
        <div class="mt-4">
            <label class="block text-sm font-semibold text-gray-900">Send via</label>
            <div class="flex items-center mt-2">
                <input type="checkbox" id="sendSms" name="sendSms" value="1" class="ml-4 mr-2" />
                <label for="sendSms" class="text-sm font-medium text-gray-900">SMS</label>

                <input type="checkbox" id="sendEmail" name="sendEmail" value="1" class="ml-4 mr-2" />
                <label for="sendEmail" class="text-sm font-medium text-gray-900">Email</label>

                <input type="checkbox" id="sendChat" name="sendChat" value="1" class="ml-4 mr-2" />
                <label for="sendChat" class="text-sm font-medium text-gray-900">In the Chat</label>
            </div>
            <button type="button" id="useTemplate" class="mt-2 w-full bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600">
                Use Template
            </button>
        </div>

        <!-- Message Input -->
        <div class="mt-4">
            <label for="messageTextArea" class="block text-sm font-semibold text-gray-900">Message</label>
            <textarea id="messageTextArea" name="message" class="w-full border border-gray-300 rounded-md p-2" required></textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-4">
            <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                Send Message
            </button>
        </div>
    </form>
</div>

@include('modals.wish-modal') <!-- Ensure this modal is set up correctly -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
    function loadEventsBasedOnCategory(categorySelector, eventDropdown) {
        $(categorySelector).change(function() {
            var categoryId = $(this).val();
            console.log("Category selected:", categoryId);

            if (categoryId) {
                $.ajax({
                    url: '/events/category/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(events) {
                        console.log("Events received:", events);
                        $(eventDropdown).empty().append('<option value="">Select Event</option>');
                        $.each(events, function(index, event) {
                            $(eventDropdown).append('<option value="' + event.id + '">' + event.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading events:", status, error);
                        $(eventDropdown).empty().append('<option value="">Error loading events</option>');
                    }
                });
            } else {
                $(eventDropdown).empty().append('<option value="">Select Event</option>');
            }
        });
    }

    function loadMessagesBasedOnEvent(eventSelector, messageDropdown) {
        $(eventSelector).change(function() {
            var eventId = $(this).val();
            console.log("Event selected:", eventId);

            if (eventId) {
                $.ajax({
                    url: '/get-messages',
                    type: 'GET',
                    data: { event_id: eventId },
                    dataType: 'json',
                    success: function(response) {
                        console.log("Full response:", response);
                        if (response.messages && response.messages.length > 0) {
                            $(messageDropdown).empty().append('<option value="">Select Message</option>');
                            $.each(response.messages, function(index, message) {
                                console.log("Processing message:", message);
                                var option = $('<option>', {
                                    value: message.id,
                                    text: message.title,
                                    'data-content': message.text  // Changed from message.content to message.text
                                });
                                console.log("Created option:", option[0].outerHTML);
                                $(messageDropdown).append(option);
                            });
                        } else {
                            console.log("No messages available");
                            $(messageDropdown).empty().append('<option value="">No messages available</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading messages:", error);
                        $(messageDropdown).empty().append('<option value="">Error loading messages</option>');
                    }
                });
            } else {
                $(messageDropdown).empty().append('<option value="">Select Message</option>');
            }
        });
    }

    function loadWishMessage(messageDropdown, messageTextarea) {
        $(messageDropdown).change(function() {
            var selectedOption = $(this).find('option:selected');
            console.log("Selected option:", selectedOption[0].outerHTML);

            var messageContent = selectedOption.data('content');
            console.log("Message content from data attribute:", messageContent);

            if (messageContent !== undefined && messageContent !== null) {
                $(messageTextarea).val(messageContent);
                console.log("Set textarea value to:", messageContent);
            } else {
                console.error('Message content is undefined or null');
                $(messageTextarea).val('');
            }
        });
    }

    // Initialize functions
    loadEventsBasedOnCategory('#event-category', '#event');
    loadMessagesBasedOnEvent('#event', '#message');
    loadWishMessage('#message', '#messageTextArea');
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the modal and button elements
        const eventModal = document.getElementById('eventModal');
        const useTemplateButton = document.getElementById('useTemplate');
        const closeModalButton = document.getElementById('closeEventModal');
        const closeEventModalButton = document.getElementById('closeEventModalButton');
        const submitEventFormButton = document.getElementById('submitEventForm');

        // Show the modal when the button is clicked
        if (useTemplateButton) {
            useTemplateButton.addEventListener('click', function () {
                eventModal.classList.remove('hidden');
            });
        }

        // Close the modal when the close button is clicked
        if (closeModalButton) {
            closeModalButton.addEventListener('click', function () {
                eventModal.classList.add('hidden');
            });
        }

        // Close the modal when the 'Cancel' button is clicked
        if (closeEventModalButton) {
            closeEventModalButton.addEventListener('click', function () {
                eventModal.classList.add('hidden');
            });
        }

        // Close the modal when 'Okay' button is clicked
        if (submitEventFormButton) {
            submitEventFormButton.addEventListener('click', function () {
                // You can add form submission logic here if needed
                eventModal.classList.add('hidden');
            });
        }

        // Close the modal if clicking outside of the modal content
        eventModal.addEventListener('click', function (event) {
            if (event.target === eventModal) {
                eventModal.classList.add('hidden');
            }
        });
    });
</script>

@endsection
