@extends('layouts.app')

@section('content')
<main class="flex-grow">
    <div class="relative bg-white">
        <div class="absolute left-0 top-0 hidden h-full w-1/2 bg-white lg:block" aria-hidden="true"></div>
        <div class="absolute right-0 top-0 hidden h-full w-1/2 bg-indigo-900 lg:block" aria-hidden="true"></div>
        <div class="relative mx-auto grid max-w-7xl grid-cols-1 gap-x-16 lg:grid-cols-2 lg:px-8 lg:pt-16">
            <h1 class="sr-only">Checkout</h1>

            <!-- Order Summary Section -->
            <section aria-labelledby="summary-heading" class="bg-indigo-900 py-12 text-indigo-300 md:px-10 lg:col-start-2 lg:row-start-1 lg:mx-auto lg:w-full lg:max-w-lg lg:bg-transparent lg:px-0 lg:pt-0">
                <div class="mx-auto max-w-2xl px-4 lg:max-w-none lg:px-0">
                    <h2 id="summary-heading" class="sr-only">Order summary</h2>
                    <dl>
                        <dt class="text-sm font-medium">Amount due</dt>
                        <dd class="mt-1 text-3xl font-bold tracking-tight text-white">${{ number_format($total, 2) }}</dd>
                    </dl>
                    <ul role="list" class="divide-y divide-white divide-opacity-10 text-sm font-medium">
                        @foreach ($cartItems as $item)
                        <li class="flex items-start space-x-4 py-6">
                            <img src="{{ Storage::url($item->product->main_image) }}" alt="{{ $item->product->name }}" class="h-20 w-20 flex-none rounded-md object-cover object-center">
                            <div class="flex-auto space-y-1">
                                <h3 class="text-white">{{ $item->product->name }}</h3>
                                <p>{{ $item->product->color }}</p>
                                <p>{{ $item->product->size }}</p>
                            </div>
                            <p class="flex-none text-base font-medium text-white">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        </li>
                        @endforeach
                    </ul>
                    <dl class="space-y-6 border-t border-white border-opacity-10 pt-6 text-sm font-medium">
                        <div class="flex items-center justify-between">
                            <dt>Subtotal</dt>
                            <dd>${{ number_format($subtotal, 2) }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt>Shipping</dt>
                            <dd>${{ number_format($shipping, 2) }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt>Taxes</dt>
                            <dd>${{ number_format($tax, 2) }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-white border-opacity-10 pt-6 text-white">
                            <dt class="text-base">Total</dt>
                            <dd class="text-base">${{ number_format($total, 2) }}</dd>
                        </div>
                    </dl>
                </div>
            </section>

            <!-- Payment and Shipping Details Section -->
            <section aria-labelledby="payment-and-shipping-heading" class="py-16 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:w-full lg:max-w-lg lg:pt-0" x-data="{ paymentMethod: 'card' }">
                <h2 id="payment-and-shipping-heading" class="sr-only">Payment and shipping details</h2>
                <form action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    <input type="hidden" id="payment_method" name="payment_method" value="card">
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
                            <div x-data="{ tab: 'me' }" class="mt-10">
                                <h3 id="details-heading" class="text-lg font-medium text-gray-900">Details</h3>

                                <!-- Details Tabs -->
                                <div class="mt-6">
                                    <div class="flex space-x-4">
                                        <button type="button" class="w-full rounded-md border border-gray-300 py-2 text-center text-sm font-medium"
                                            :class="tab === 'me' ? 'bg-indigo-600 text-white' : 'bg-gray-200'"
                                            @click="tab = 'me'">Me</button>

                                        <button type="button" class="w-full rounded-md border border-gray-300 py-2 text-center text-sm font-medium"
                                            :class="tab === 'contact' ? 'bg-indigo-600 text-white' : 'bg-gray-200'"
                                            @click="tab = 'contact'">To My Contact</button>
                                    </div>
                                </div>


                                <!-- Details for "Me" -->
                                <div x-show="tab === 'me'" class="mt-6 space-y-6">
                                    <h4 class="text-md font-medium text-gray-900">Shipping Address</h4>
                                    <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-3">
                                        <div class="sm:col-span-3">
                                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                            <div class="mt-1">
                                                <input type="text" id="address" name="address" value="{{ $userProfile->address ?? '' }}" required autocomplete="street-address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                            <div class="mt-1">
                                                <input type="text" id="city" name="city" value="{{ $userProfile->city ?? '' }}" required autocomplete="address-level2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                                            <div class="mt-1">
                                                <input type="text" id="region" name="region" value="{{ $userProfile->state ?? '' }}" required autocomplete="address-level1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="postal-code" class="block text-sm font-medium text-gray-700">Postal code</label>
                                            <div class="mt-1">
                                                <input type="text" id="postal-code" name="postal-code" value="{{ $userProfile->zip ?? '' }}" required autocomplete="postal-code" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Details for "To My Contact" -->
                                <div x-show="tab === 'contact'" class="mt-6 space-y-6">
                                    <!-- To My Contact - To: Label with Input -->
                                    <div class="mt-4">
                                        <div class="flex items-center">
                                            <label class="block text-sm font-semibold text-gray-900 mr-2">To:</label>
                                            <input type="text" id="contact-search" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Start typing a contact name...">
                                        </div>

                                        <ul id="contact-suggestions" class="mt-2 bg-white border border-gray-300 rounded-md shadow-md hidden"></ul>

                                        <div id="selected-contacts" class="mt-4 space-y-2"></div>
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
                                        @click="paymentMethod = 'card'; document.getElementById('payment_method').value = 'card'">Credit/Debit Card</button>

                                    <button type="button" class="w-full rounded-md border border-gray-300 py-2 text-center text-sm font-medium"
                                        :class="paymentMethod === 'cod' ? 'bg-indigo-600 text-white' : 'bg-gray-200'"
                                        @click="paymentMethod = 'cod'; document.getElementById('payment_method').value = 'cod'">Cash on Delivery</button>
                                </div>
                            </div>

                            <!-- Credit/Debit Card Payment Fields -->
                            <div x-show="paymentMethod === 'card'" class="mt-6 space-y-6">
                                <div>
                                    <label for="card-number" class="block text-sm font-medium text-gray-700">Card number</label>
                                    <div class="mt-1">
                                        <input type="text" id="card-number" name="card-number" required x-bind:required="paymentMethod === 'card'" autocomplete="cc-number"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-x-4">
                                    <div>
                                        <label for="expiration-date" class="block text-sm font-medium text-gray-700">Expiration date (MM/YY)</label>
                                        <div class="mt-1">
                                            <input type="text" id="expiration-date" name="expiration-date" required x-bind:required="paymentMethod === 'card'" autocomplete="cc-exp"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                                        <div class="mt-1">
                                            <input type="text" id="cvc" name="cvc" required x-bind:required="paymentMethod === 'card'" autocomplete="cc-csc"
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

                                // Add a new shipping address section for the selected contact
                                $('#shipping-sections').append(createShippingSection(contact));
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

    // Function to create a new shipping address section
    function createShippingSection(contact) {
        return `
            <div id="shipping-section-${contact.id}" class="mt-10">
                <h3 class="text-lg font-medium text-gray-900">Shipping address for ${contact.name}</h3>
                <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-3">
                    <div class="sm:col-span-3">
                        <label for="address-${contact.id}" class="block text-sm font-medium text-gray-700">Address</label>
                        <div class="mt-1">
                            <input type="text" id="address-${contact.id}" name="address[${contact.id}]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required autocomplete="street-address">
                        </div>
                    </div>
                    <div>
                        <label for="city-${contact.id}" class="block text-sm font-medium text-gray-700">City</label>
                        <div class="mt-1">
                            <input type="text" id="city-${contact.id}" name="city[${contact.id}]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required autocomplete="address-level2">
                        </div>
                    </div>
                    <div>
                        <label for="region-${contact.id}" class="block text-sm font-medium text-gray-700">State / Province</label>
                        <div class="mt-1">
                            <input type="text" id="region-${contact.id}" name="region[${contact.id}]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required autocomplete="address-level1">
                        </div>
                    </div>
                    <div>
                        <label for="postal-code-${contact.id}" class="block text-sm font-medium text-gray-700">Postal code</label>
                        <div class="mt-1">
                            <input type="text" id="postal-code-${contact.id}" name="postal_code[${contact.id}]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required autocomplete="postal-code">
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

        // Remove the corresponding shipping section
        $('#shipping-section-' + contactId).remove();
    });
});
</script>
