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

                        <!-- Shipping Address Section -->
                        <div class="mt-10">
                            <h3 id="shipping-heading" class="text-lg font-medium text-gray-900">Shipping address</h3>
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
