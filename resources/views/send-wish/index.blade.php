@extends('layouts.user.app')

@section('content')

<div class="mb-8">
    <h3 class="text-xl font-bold text-gray-900 mb-4">Send Wish</h3>

    <!-- Display Flash Messages -->
    @if (session('status'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p class="font-bold">Success!</p>
        <p>{{ session('status') }}</p>
    </div>
    @endif

    @if (session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <p class="font-bold">Error!</p>
        <p>{{ session('error') }}</p>
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <p class="font-bold">Oops!</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('send.wish') }}" method="POST">
        @csrf
        <!-- Contacts List -->
        <div class="mt-4">
            <div class="flex items-center">
                <label class="block text-sm font-semibold text-gray-900 mr-2">To:</label>
                <input type="text" id="contact-search" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Start typing a contact name...">
            </div>

            <ul id="contact-suggestions" class="mt-2 bg-white border border-gray-300 rounded-md shadow-md hidden"></ul>

            <div id="selected-contacts" class="mt-4 space-y-2"></div>
        </div>

        <div id="hidden-contact-inputs"></div>

        <!-- Message Input -->
        <div class="mt-4 flex items-start">
            <label for="messageTextArea" class="block text-sm font-semibold text-gray-900 mr-2">Message:</label>
            <div class="relative flex w-full">
                <textarea id="messageTextArea" name="message" class="w-full border border-gray-300 rounded-md p-2 pr-12" required></textarea>
                <!-- Use Template Icon inside textarea container -->
                <button type="button" id="useTemplate" class="ml-2 text-gray-600 hover:text-gray-800 focus:outline-none">
                    <i class="fas fa-file-alt text-2xl"></i>
                </button>
            </div>
        </div>

        <!-- Send via Part -->
        <div class="flex justify-between items-center mt-4">
            <!-- Send via options -->
            <div class="flex items-center">
                <label class="block text-sm font-semibold text-gray-900 mr-2">Send via:</label>

                <input type="checkbox" id="sendSms" name="sendVia[]" value="sms" class="ml-4 mr-2" />
                <label for="sendSms" class="text-sm font-medium text-gray-900">SMS</label>

                <input type="checkbox" id="sendEmail" name="sendVia[]" value="email" class="ml-4 mr-2" />
                <label for="sendEmail" class="text-sm font-medium text-gray-900">Email</label>

                <input type="checkbox" id="sendChat" name="sendVia[]" value="chat" class="ml-4 mr-2" />
                <label for="sendChat" class="text-sm font-medium text-gray-900">In the Chat</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-1/3 bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                Send Message
            </button>
        </div>
    </form>
</div>


@include('modals.wish-modal')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        let selectedContacts = [];

        $('#contact-search').on('keyup', function() {
            let query = $(this).val();

            if (query.length >= 2) {
                $.ajax({
                    url: '{{ route("contacts.search") }}',
                    type: 'GET',
                    data: { term: query },
                    success: function(data) {
                        $('#contact-suggestions').empty().removeClass('hidden');

                        data.forEach(contact => {
                            let contactItem = $('<li/>', {
                                text: contact.name,
                                class: 'cursor-pointer hover:bg-gray-100 p-2'
                            }).on('click', function() {
                                if (!selectedContacts.includes(contact.id)) {
                                    selectedContacts.push(contact.id);

                                    // Display selected contacts with delete button
                                    $('#selected-contacts').append(
                                        `<div class="bg-blue-100 px-2 py-1 rounded inline-block mt-2 mr-2">
                                            ${contact.name}
                                            <button type="button" class="delete-contact text-red-500 ml-2" data-id="${contact.id}">&times;</button>
                                        </div>`
                                    );
                                    $('#hidden-contact-inputs').append(
                                        `<input type="hidden" name="contacts[]" value="${contact.id}">`
                                    );
                                }

                                $('#contact-suggestions').addClass('hidden');
                                $('#contact-search').val('');
                            });

                            $('#contact-suggestions').append(contactItem);
                        });

                        if (data.length === 0) {
                            $('#contact-suggestions').append('<li class="p-2 text-gray-500">No contacts found</li>');
                        }
                    }
                });
            } else {
                $('#contact-suggestions').addClass('hidden');
            }
        });

        $('#send-wish-form').on('submit', function(e) {
            var sendViaOptions = $('input[name="sendVia[]"]:checked').length;
            if (sendViaOptions === 0) {
                e.preventDefault();
                alert('Please select at least one "Send via" option.');
            }
        });

        // Delete selected contact
        $(document).on('click', '.delete-contact', function() {
            const contactId = $(this).data('id');
            selectedContacts = selectedContacts.filter(id => id !== contactId);

            // Remove the contact from the displayed list
            $(this).parent().remove();

            // Remove the corresponding hidden input
            $('#hidden-contact-inputs input[value="' + contactId + '"]').remove();
        });
    });
</script>

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
