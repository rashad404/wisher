@extends('layouts.app')

@section('content')
<main class="flex-grow">
    <div class="relative bg-white">
        <div class="absolute left-0 top-0 hidden h-full w-1/2 bg-white lg:block" aria-hidden="true"></div>
        <div class="absolute right-0 top-0 hidden h-full w-1/2 bg-indigo-900 lg:block" aria-hidden="true"></div>
        <div class="relative mx-auto grid max-w-7xl grid-cols-1 gap-x-16 lg:grid-cols-2 lg:px-8 lg:pt-16">
            <h1 class="sr-only">Checkout</h1>

            <div id="warning-message" class="hidden mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                <p class="font-bold">Warning</p>
                <p id="warning-text"></p>
            </div>

            <!-- Order Summary Section -->
            <section aria-labelledby="summary-heading" class="bg-indigo-900 py-12 text-indigo-300 md:px-10 lg:col-start-2 lg:row-start-1 lg:mx-auto lg:w-full lg:max-w-lg lg:bg-transparent lg:px-0 lg:pt-0">
                <div class="mx-auto max-w-2xl px-4 lg:max-w-none lg:px-0">
                    <h2 id="summary-heading" class="sr-only">Order summary</h2>
                    <dl>
                        <dt class="text-sm font-medium">Amount due</dt>
                        <dd class="mt-1 text-3xl font-bold tracking-tight text-white" id="total-amount">${{ number_format($total, 2) }}</dd>
                    </dl>
                    <ul role="list" class="divide-y divide-white divide-opacity-10 text-sm font-medium">
                        @foreach ($cartItems as $item)
                        <li class="flex items-start space-x-4 py-6">
                            <img src="{{ Storage::url($item->product->main_image) }}" alt="{{ $item->product->name }}" class="h-20 w-20 flex-none rounded-md object-cover object-center">
                            <div class="flex-auto space-y-1">
                                <h3 class="text-white">{{ $item->product->name }}</h3>
                                <p>{{ $item->product->color }}</p>
                                <p>{{ $item->product->size }}</p>
                                <p class="text-indigo-200">Quantity: <span class="item-quantity" data-base-quantity="{{ $item->quantity }}">{{ $item->quantity }}</span></p>
                            </div>
                            <p class="flex-none text-base font-medium text-white item-total-price" data-base-price="{{ $item->product->price * $item->quantity }}">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        </li>
                        @endforeach
                    </ul>
                    <dl class="space-y-6 border-t border-white border-opacity-10 pt-6 text-sm font-medium">
                        <div class="flex items-center justify-between">
                            <dt>Subtotal</dt>
                            <dd id="subtotal">${{ number_format($subtotal, 2) }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt>Shipping</dt>
                            <dd id="shipping">${{ number_format($shipping, 2) }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt>Taxes</dt>
                            <dd id="taxes">${{ number_format($tax, 2) }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-white border-opacity-10 pt-6 text-white">
                            <dt class="text-base">Total</dt>
                            <dd class="text-base" id="grand-total">${{ number_format($total, 2) }}</dd>
                        </div>
                    </dl>
                    <div class="mt-6 text-sm text-indigo-200" id="contacts-note"></div>
                </div>
            </section>

            <!-- Payment and Shipping Details Section -->
            <section aria-labelledby="payment-and-shipping-heading" class="py-16 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:w-full lg:max-w-lg lg:pt-0" x-data="{ tab: 'me', paymentMethod: 'card' }">
                <h2 id="payment-and-shipping-heading" class="sr-only">Payment and shipping details</h2>
                <form action="{{ route('payment.process') }}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" id="payment_method" name="payment_method" x-model="paymentMethod">
                    <input type="hidden" name="tab" x-model="tab">
                    <div class="mx-auto max-w-2xl px-4 lg:max-w-none lg:px-0">
                        <!-- Contact Information Section -->
                        <div>
                            <h3 id="contact-info-heading" class="text-lg font-medium text-gray-900">Contact information</h3>
                            <div class="mt-6">
                                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                                <div class="mt-1">
                                    <input type="email" id="email-address" name="email-address" value="{{ $userEmail }}" required autocomplete="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-10">
                            <!-- Details Tabs -->
                            <div class="mt-10">
                                <h3 id="details-heading" class="text-lg font-medium text-gray-900">Send To:</h3>

                                <!-- Details Tabs -->
                                <div class="mt-6">
                                    <div class="flex space-x-4">
                                        <button type="button" class="w-full rounded-md border border-gray-300 py-2 text-center text-sm font-medium"
                                            :class="tab === 'me' ? 'bg-indigo-600 text-white' : 'bg-gray-200'"
                                            @click="tab = 'me'">Me</button>

                                        <button type="button" class="w-full rounded-md border border-gray-300 py-2 text-center text-sm font-medium"
                                            :class="tab === 'contact' ? 'bg-indigo-600 text-white' : 'bg-gray-200'"
                                            @click="tab = 'contact'">My Contacts</button>
                                    </div>
                                </div>

                                <!-- Details for "Me" -->
                                <div x-show="tab === 'me'" class="mt-6 space-y-6">
                                    <h4 class="text-md font-medium text-gray-900">Shipping Address</h4>
                                    <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-3">
                                        <div class="sm:col-span-3">
                                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                            <div class="mt-1">
                                                <input type="text" id="address" name="address[me]" value="{{ $userProfile->address ?? '' }}" x-bind:required="tab === 'me'" autocomplete="street-address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                            <div class="mt-1">
                                                <input type="text" id="city" name="city[me]" value="{{ $userProfile->city ?? '' }}" x-bind:required="tab === 'me'" autocomplete="address-level2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                                            <div class="mt-1">
                                                <input type="text" id="region" name="region[me]" value="{{ $userProfile->state ?? '' }}" x-bind:required="tab === 'me'" autocomplete="address-level1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="postal-code" class="block text-sm font-medium text-gray-700">Postal code</label>
                                            <div class="mt-1">
                                                <input type="text" id="postal-code" name="postal-code[me]" value="{{ $userProfile->zip ?? '' }}" x-bind:required="tab === 'me'" autocomplete="postal-code" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Details for "To My Contacts" -->
                                <div x-show="tab === 'contact'" class="mt-6 space-y-6">
                                    <div class="mt-4">
                                        <!-- Contact Search Section -->
                                        <div class="flex items-center">
                                            <label class="block text-sm font-semibold text-gray-900 mr-2">To:</label>
                                            <!-- Assuming you have some mechanism to select contacts, include their IDs here -->
                                            <input type="text" id="contact-search" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Start typing a contact name...">
                                        </div>

                                        <ul id="contact-suggestions" class="mt-2 bg-white border border-gray-300 rounded-md shadow-md hidden"></ul>

                                        <!-- This section will hold the selected contact details (IDs, addresses) -->
                                        <div id="selected-contacts" class="mt-4 space-y-2">
                                            @foreach($contacts as $contact)
                                            <div class="contact" data-contact-id="{{ $contact->id }}">
                                                <input type="hidden" name="contacts[]" value="{{ $contact->id }}"> <!-- Hidden input for contact ID -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Delivery Options -->
                                    <div class="mt-6">
                                        <h4 class="text-md font-medium text-gray-900">Delivery Options</h4>

                                        <!-- Radio button to send now -->
                                        <div class="flex items-center mt-4 space-x-3">
                                            <input id="send-now-contact" type="radio" name="delivery_time_contact" value="now" class="form-radio text-indigo-600 h-5 w-5" checked>
                                            <label for="send-now-contact" class="block text-sm font-medium text-gray-700">Send Now</label>
                                        </div>

                                        <!-- Radio button to select date -->
                                        <div class="flex items-center mt-4 space-x-3">
                                            <input id="send-later-contact" type="radio" name="delivery_time_contact" value="later" class="form-radio text-indigo-600 h-5 w-5">
                                            <label for="send-later-contact" class="block text-sm font-medium text-gray-700">Select Date</label>
                                        </div>

                                        <!-- Date picker section, hidden initially -->
                                        <div id="date-picker-contact-section" class="mt-4 hidden"> <!-- Add the "hidden" class here -->
                                            <label for="delivery_date_contact" class="block text-sm font-medium text-gray-700">Select Delivery Date</label>
                                            <input type="date" id="delivery_date_contact" name="delivery_date_contact" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Shipping Address Section -->
                        <div class="mt-10">
                            <div id="shipping-sections">
                                <!-- Shipping addresses will be dynamically added here -->
                            </div>
                        </div>

                        <!-- Payment Method Section with Tabs -->
                        <div class="mt-10">
                            <h3 id="payment-heading" class="text-lg font-medium text-gray-900">Payment details</h3>

                            <!-- Payment Tabs -->
                            <div class="mt-6">
                                <div class="flex space-x-4">
                                    <button type="button" class="w-full rounded-md border border-gray-300 py-2 text-center text-sm font-medium"
                                        :class="paymentMethod === 'card' ? 'bg-indigo-600 text-white' : 'bg-gray-200'"
                                        @click="paymentMethod = 'card'">Credit/Debit Card</button>

                                    <button type="button" class="w-full rounded-md border border-gray-300 py-2 text-center text-sm font-medium"
                                        :class="paymentMethod === 'cod' ? 'bg-indigo-600 text-white' : 'bg-gray-200'"
                                        @click="paymentMethod = 'cod'">Cash on Delivery</button>
                                </div>
                            </div>

                            <!-- Credit/Debit Card Payment Fields -->
                            <div x-show="paymentMethod === 'card'" class="mt-6 space-y-6">
                                <div>
                                    <label for="card-number" class="block text-sm font-medium text-gray-700">Card number</label>
                                    <div class="mt-1">
                                        <input type="text" id="card-number" name="card-number" x-bind:required="paymentMethod === 'card'" autocomplete="cc-number"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-x-4">
                                    <div>
                                        <label for="expiration-date" class="block text-sm font-medium text-gray-700">Expiration date (MM/YY)</label>
                                        <div class="mt-1">
                                            <input type="text" id="expiration-date" name="expiration-date" x-bind:required="paymentMethod === 'card'" autocomplete="cc-exp"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                                        <div class="mt-1">
                                            <input type="text" id="cvc" name="cvc" x-bind:required="paymentMethod === 'card'" autocomplete="cc-csc"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-10">
                            <button type="submit" class="block w-full rounded-md bg-indigo-600 py-3 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Order now
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</main>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initially hide the date picker if "Send Now" is selected
        const sendNowRadio = document.getElementById('send-now-contact');
        const sendLaterRadio = document.getElementById('send-later-contact');
        const datePickerSection = document.getElementById('date-picker-contact-section');

        // Check the initial state of the radio buttons
        if (sendNowRadio.checked) {
            datePickerSection.classList.add('hidden');  // Hide date picker initially
        }

        // Event listener for "Send Now"
        sendNowRadio.addEventListener('change', function() {
            datePickerSection.classList.add('hidden');
        });

        // Event listener for "Send Later"
        sendLaterRadio.addEventListener('change', function() {
            datePickerSection.classList.remove('hidden');
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    let selectedContacts = [];
    let baseSubtotal = {{ $subtotal }};
    let baseShipping = {{ $shipping }};
    let baseTax = {{ $tax }};

    function updatePrices() {
        let contactCount = Math.max(selectedContacts.length, 1);
        let subtotal = baseSubtotal * contactCount;
        let shipping = baseShipping * contactCount;
        let taxes = baseTax * contactCount;
        let total = subtotal + shipping + taxes;

        $('.item-quantity').each(function() {
            let baseQuantity = $(this).data('base-quantity');
            $(this).text(baseQuantity * contactCount);
        });

        $('.item-total-price').each(function() {
            let basePrice = $(this).data('base-price');
            $(this).text('$' + (basePrice * contactCount).toFixed(2));
        });

        $('#subtotal').text('$' + subtotal.toFixed(2));
        $('#shipping').text('$' + shipping.toFixed(2));
        $('#taxes').text('$' + taxes.toFixed(2));
        $('#grand-total').text('$' + total.toFixed(2));
        $('#total-amount').text('$' + total.toFixed(2));

        updateContactsNote();
    }

    function updateContactsNote() {
        console.log("Updating contacts note. Selected contacts:", selectedContacts.length); // Debug log
        let warningElem = $('#warning-message');
        let warningTextElem = $('#warning-text');

        if (selectedContacts.length > 1) {
            warningTextElem.text(`You are sending to ${selectedContacts.length} contacts. Quantities and prices have been adjusted accordingly.`);
            warningElem.removeClass('hidden').show();
        } else if (selectedContacts.length === 1) {
            warningTextElem.text(`You are sending to 1 contact.`);
            warningElem.removeClass('hidden').show();
        } else {
            warningElem.addClass('hidden').hide();
        }
        console.log("Warning message visibility:", !warningElem.hasClass('hidden')); // Debug log
    }

    function addContact(contact) {
        if (!selectedContacts.includes(contact.id)) {
            selectedContacts.push(contact.id);

            $('#selected-contacts').append(
                `<div class="bg-blue-100 px-2 py-1 rounded inline-block mt-2 mr-2">
                    ${contact.name}
                    <button type="button" class="delete-contact text-red-500 ml-2" data-id="${contact.id}">&times;</button>
                </div>`
            );
            $('#hidden-contact-inputs').append(
                `<input type="hidden" name="contacts[]" value="${contact.id}">`
            );

            // Add shipping section for the new contact
            $('#shipping-sections').append(createShippingSection(contact));

            updatePrices();
        }

        $('#contact-suggestions').addClass('hidden');
        $('#contact-search').val('');
    }

    function createShippingSection(contact) {
        return `
            <div id="shipping-section-${contact.id}" class="mt-10">
                <h3 class="text-lg font-medium text-gray-900">Shipping address for ${contact.name || 'Unnamed'}</h3>
                <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-3">
                    <div class="sm:col-span-3">
                        <label for="address-${contact.id}" class="block text-sm font-medium text-gray-700">Address</label>
                        <div class="mt-1">
                            <input type="text" id="address-${contact.id}" name="address[${contact.id}]" value="${contact.address || ''}" required autocomplete="street-address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter address">
                        </div>
                    </div>
                    <div>
                        <label for="city-${contact.id}" class="block text-sm font-medium text-gray-700">City</label>
                        <div class="mt-1">
                            <input type="text" id="city-${contact.id}" name="city[${contact.id}]" value="" required autocomplete="address-level2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter city">
                        </div>
                    </div>
                    <div>
                        <label for="region-${contact.id}" class="block text-sm font-medium text-gray-700">State / Province</label>
                        <div class="mt-1">
                            <input type="text" id="region-${contact.id}" name="region[${contact.id}]" value="" required autocomplete="address-level1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter state or province">
                        </div>
                    </div>
                    <div>
                        <label for="postal-code-${contact.id}" class="block text-sm font-medium text-gray-700">Postal code</label>
                        <div class="mt-1">
                            <input type="text" id="postal-code-${contact.id}" name="postal-code[${contact.id}]" value="" required autocomplete="postal-code" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter postal code">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="note-${contact.id}" class="block text-sm font-medium text-gray-700">Note to ${contact.name || 'Recipient'}</label>
                        <div class="mt-1 flex items-center">
                            <textarea
                                id="note-${contact.id}"
                                name="notes[${contact.id}]"
                                rows="3"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Enter any notes here"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Delete selected contact
    $(document).on('click', '.delete-contact', function() {
        const contactId = $(this).data('id');
        selectedContacts = selectedContacts.filter(id => id !== contactId);

        // Remove the contact from the displayed list
        $(this).parent().remove();

        // Remove the corresponding hidden input
        $('#hidden-contact-inputs input[value="' + contactId + '"]').remove();

        // Remove the shipping section for this contact
        $(`#shipping-section-${contactId}`).remove();

        updatePrices();
    });

    // Contact search functionality
    $('#contact-search').on('keyup', function() {
        let query = $(this).val();
        console.log("Search query:", query);

        if (query.length >= 2) {
            $.ajax({
                url: "{{ route('contact.search') }}", // Using Laravel's route helper
                type: 'GET',
                data: { term: query },
                success: function(data) {
                    console.log("Received data:", data);
                    $('#contact-suggestions').empty().removeClass('hidden');

                    if (data.length === 0) {
                        $('#contact-suggestions').append('<li class="p-2 text-gray-500">No contacts found</li>');
                    } else {
                        data.forEach(contact => {
                            let contactItem = $('<li/>', {
                                text: contact.name,
                                class: 'cursor-pointer hover:bg-gray-100 p-2'
                            }).on('click', function() {
                                addContact(contact);
                            });

                            $('#contact-suggestions').append(contactItem);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error searching contacts:", status, error);
                    $('#contact-suggestions').empty().removeClass('hidden')
                        .append('<li class="p-2 text-red-500">Error searching contacts</li>');
                }
            });
        } else {
            $('#contact-suggestions').addClass('hidden');
        }
    });

    // Hide contact suggestions when clicking outside
    $(document).click(function(event) {
        if (!$(event.target).closest('#contact-search, #contact-suggestions').length) {
            $('#contact-suggestions').addClass('hidden');
        }
    });

    // Initialize date picker functionality
    document.addEventListener('DOMContentLoaded', function () {
        const sendNowRadio = document.getElementById('send-now-contact');
        const sendLaterRadio = document.getElementById('send-later-contact');
        const datePickerSection = document.getElementById('date-picker-contact-section');

        if (sendNowRadio.checked) {
            datePickerSection.classList.add('hidden');
        }

        sendNowRadio.addEventListener('change', function() {
            datePickerSection.classList.add('hidden');
        });

        sendLaterRadio.addEventListener('change', function() {
            datePickerSection.classList.remove('hidden');
        });
    });
});
</script>

