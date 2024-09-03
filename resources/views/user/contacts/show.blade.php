@extends('layouts.user.app')

@section('content')


@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif


    <!-- Breadcrumbs -->
    <div class="py-4">
        <x-breadcrumbs :links="[
            ['url' => route('user.index'), 'label' => 'Home'],
            ['url' => route('user.contacts.index'), 'label' => 'Contacts'],
            ['url' => route('user.contacts.show', $contact->id), 'label' => $contact->name],
        ]"/>
    </div>

    <div class="flex justify-center items-start py-8">
        <div class="w-full max-w-4xl">
            <!-- Contact Details -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <img class="h-24 w-24 rounded-full border-4 border-gray-300" src="{{ Storage::url($contact->photo) }}" alt="{{ $contact->name }}">
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $contact->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $contact->title ?? 'No Title' }}</p>
                    </div>
                </div>
                <!-- Edit Button -->
                <a href="{{ route('user.contacts.edit', $contact->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-semibold rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                    Edit
                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M16.732 3.732a2.5 2.5 0 113.536 3.536l-10.607 10.607a4 4 0 01-1.414.828l-4.242 1.414a1 1 0 01-1.272-1.272l1.414-4.242a4 4 0 01.828-1.414l10.607-10.607z" />
                    </svg>
                </a>
            </div>

            <!-- Related Events Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Related Events</h3>
                    <a href="{{ route('contacts.events.index', $contact->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        Manage Events
                    </a>
                </div>
                @if($contact->events->isNotEmpty())
                    <ul class="space-y-2">
                        @foreach($contact->events as $event)
                            <li class="flex justify-between text-sm text-gray-700">
                                <span class="font-semibold text-gray-900">{{ $event->name }}</span>
                                <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">No events found for this contact.</p>
                @endif
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                <div>
                    <span class="block text-sm font-semibold text-gray-900">Phone</span>
                    <span class="block text-gray-700">{{ $contact->phone_number ?: 'No Phone Number' }}</span>
                </div>
                <div>
                    <span class="block text-sm font-semibold text-gray-900">Email</span>
                    <a href="mailto:{{ $contact->email ?? '#' }}" class="block text-indigo-600 underline">
                        {{ $contact->email ?: 'No Email' }}
                    </a>
                </div>
                <div>
                    <span class="block text-sm font-semibold text-gray-900">Birthdate</span>
                    <span class="block text-gray-700">
                        {{ $contact->birthdate ? \Carbon\Carbon::parse($contact->birthdate)->format('d M Y') : 'No Birthdate' }}
                    </span>
                </div>
                <div>
                    <span class="block text-sm font-semibold text-gray-900">Address</span>
                    <span class="block text-gray-700">{{ $contact->address ?: 'No Address' }}</span>
                </div>
            </div>

            <!-- Interests Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Interests</h3>
                    <a href="{{ route('contacts.interests.index', $contact->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Manage Interests</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Likes -->
                    <div>
                        <h4 class="text-lg font-semibold text-green-600 mb-2">Likes</h4>
                        @php
                            $likes = $contact->interests()->where('contact_interests.type', 'like')->get();
                        @endphp
                        @if($likes->isEmpty())
                            <p class="text-gray-500 text-sm">No likes added.</p>
                        @else
                            <ul class="space-y-2">
                                @foreach($likes as $like)
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-700">{{ $like->trans('name') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Dislikes -->
                    <div>
                        <h4 class="text-lg font-semibold text-red-600 mb-2">Dislikes</h4>
                        @php
                            $dislikes = $contact->interests()->where('contact_interests.type', 'dislike')->get();
                        @endphp
                        @if($dislikes->isEmpty())
                            <p class="text-gray-500 text-sm">No dislikes added.</p>
                        @else
                            <ul class="space-y-2">
                                @foreach($dislikes as $dislike)
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-red-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-700">{{ $dislike->trans('name') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Groups Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Groups</h3>
                    <a href="{{ route('contacts.groups.index', $contact->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        Manage Groups
                    </a>
                </div>
                @if($contact->groups->isNotEmpty())
                    <ul class="space-y-2">
                        @foreach($contact->groups as $group)
                            <li class="flex justify-between items-center text-sm text-gray-700">
                                <a href="{{ route('contacts.groups.show', [$contact->id, $group->id]) }}" class="font-semibold text-indigo-600 hover:text-indigo-900">
                                    {{ $group->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">This contact is not in any groups.</p>
                @endif
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Send Message</h3>

                <form action="{{ route('send.message', ['contactId' => $contact->id]) }}" method="POST">
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

                <div class="flex gap-6 justify-center mt-4">
                    @if($contact->registered_user_id)
                        <a href="{{ route('chat.withUser', $contact->registered_user_id) }}" class="flex items-center justify-center w-48 rounded-md bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4m-2-2v4m0 0v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6m6 6V6a2 2 0 012-2h6a2 2 0 012 2v6" />
                            </svg>
                            Chat with User
                        </a>
                </div>
                    @else
                        <button type="button" disabled class="flex items-center justify-center w-48 rounded-md bg-gray-400 px-6 py-3 text-sm font-semibold text-white shadow-md">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4m-2-2v4m0 0v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6m6 6V6a2 2 0 012-2h6a2 2 0 012 2v6" />
                            </svg>
                            Not Registered
                        </button>
                    @endif
                    <button type="button" class="flex items-center justify-center w-48 rounded-md bg-yellow-600 px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8V6m0 12v-2m8-10H4m16 10H4m5-8a4 4 0 00-8 0h2a2 2 0 114 0h6a2 2 0 114 0h2a4 4 0 00-8 0h-2zM5 16v2m10-2v2" />
                        </svg>
                        Send Gift
                    </button>
                </div>
            </div>
        </div>
    </div>

@include('modals.event-modal')
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to load events based on selected category
        function loadEventsBasedOnCategory(categorySelector, eventDropdown) {
            $(categorySelector).change(function() {
                var categoryId = $(this).val();

                console.log("Category selected:", categoryId); // Debugging log

                if (categoryId) {
                    $.ajax({
                        url: '/events/category/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(events) {
                            $(eventDropdown).empty().append('<option value="">Select Event</option>');
                            $.each(events, function(index, event) {
                                $(eventDropdown).append('<option value="' + event.id + '">' + event.name + '</option>');
                            });
                            console.log("Events loaded:", events); // Debugging log
                        },
                        error: function(xhr, status, error) {
                            console.log("Error loading events:", status, error); // Debugging log
                            $(eventDropdown).empty().append('<option value="">Error loading events</option>');
                        }
                    });
                } else {
                    $(eventDropdown).empty().append('<option value="">Select Event</option>');
                }
            });
        }

        // Function to load messages based on selected event
        function loadMessagesBasedOnEvent(eventSelector, messageDropdown) {
            $(eventSelector).change(function() {
                var eventId = $(this).val();

                console.log("Event selected:", eventId); // Debugging log

                if (eventId) {
                    $.ajax({
                        url: '/get-messages',
                        type: 'GET',
                        data: { event_id: eventId },
                        success: function(response) {
                            console.log("Messages loaded:", response.messages); // Debugging log
                            if (response.messages && response.messages.length > 0) {
                                $(messageDropdown).empty().append('<option value="">Select Message</option>');
                                $.each(response.messages, function(index, message) {
                                    $(messageDropdown).append(
                                        '<option value="' + message.id + '" data-content="' + message.content + '">' + message.title + '</option>'
                                    );
                                });
                            } else {
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

        // Function to load the wish message based on selected message title
        function loadWishMessage(messageDropdown, messageTextarea) {
            $(messageDropdown).change(function() {
                var selectedOption = $(this).find('option:selected');
                var messageContent = selectedOption.data('content');
                if (messageContent !== undefined) {
                    $(messageTextarea).val(messageContent);
                } else {
                    console.error('Message content is undefined');
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

    // Ensure the modal and button exist
    if (eventModal && useTemplateButton) {
        // Show the modal when the button is clicked
        useTemplateButton.addEventListener('click', function () {
            eventModal.classList.remove('hidden');
        });

        // Close the modal when the close button is clicked
        const closeModalButton = eventModal.querySelector('.close');
        if (closeModalButton) {
            closeModalButton.addEventListener('click', function () {
                eventModal.classList.add('hidden');
            });
        }

        // Close the modal if clicking outside of the modal content
        eventModal.addEventListener('click', function (event) {
            if (event.target === eventModal) {
                eventModal.classList.add('hidden');
            }
        });
    }
});
</script>

<script>
    /*Opening Modal*/
    $(document).ready(function() {
        // Function to open the modal
        function openEventModal() {
            $('#eventModal').removeClass('hidden');
        }

        // Function to close the modal
        function closeEventModal() {
            $('#eventModal').addClass('hidden');
        }

        // Open the modal
        $('#openEventModalButton').click(function() {
            openEventModal();
        });

        // Close the modal when clicking the close button
        $('#closeEventModal, #closeEventModalButton').click(function() {
            closeEventModal();
        });

        // Handle event category change
        $('#event-category').change(function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/events/category/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(events) {
                        $('#event').empty().append('<option value="">Select Event</option>');
                        $.each(events, function(index, event) {
                            $('#event').append('<option value="' + event.id + '">' + event.name + '</option>');
                        });
                    }
                });
            } else {
                $('#event').empty().append('<option value="">Select Event</option>');
            }
        });

        // Handle modal form submission
        $('#submitEventForm').click(function(e) {
            e.preventDefault(); // Prevent default form submission
            var selectedEvent = $('#event').val();
            if (selectedEvent) {
                // Perform any required action with the selected event
                console.log("Selected Event ID:", selectedEvent);
                // Close the modal after submission
                closeEventModal();
            } else {
                alert('Please select an event.');
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Function to load messages based on selected event
        function loadMessage(eventSelector, messageDropdown) {
            $(eventSelector).change(function() {
                var eventId = $(this).val();
                if (eventId) {
                    $.ajax({
                        url: '/get-messages',
                        type: 'GET',
                        data: { event_id: eventId },
                        success: function(response) {
                            console.log("Response from server:", response); // Debugging log
                            if (response.messages && response.messages.length > 0) {
                                $(messageDropdown).empty().append('<option value="">Select Message</option>');
                                $.each(response.messages, function(index, message) {
                                    console.log("Appending message:", message); // Debugging log
                                    $(messageDropdown).append(
                                        '<option value="' + message.id + '" data-content="' + message.text + '">' + message.text + '</option>'
                                    );
                                });
                            } else {
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

        // Populate textarea when a message is selected
        $('#message').change(function() {
            var selectedOption = $(this).find('option:selected');
            console.log("Selected option:", selectedOption); // Debugging log
            var messageContent = selectedOption.data('content');
            console.log("Message content:", messageContent); // Debugging log
            if (messageContent !== undefined && messageContent !== null) {
                $('#messageTextArea').val(messageContent);
            } else {
                console.error('Message content is undefined');
                $('#messageTextArea').val(''); // Clear textarea if no content found
            }
        });

        // Initialize message loading
        loadMessage('#event', '#message');
    });
    </script>
