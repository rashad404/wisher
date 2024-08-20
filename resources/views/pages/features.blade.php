@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Our Features</h1>

        <!-- Feature Section 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 6.75L15.75 12 9.75 17.25" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Automated Gifting</h2>
                <p class="text-gray-600">Automatically send gifts based on preferences and important dates, ensuring you never miss an occasion.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Custom Wishes</h2>
                <p class="text-gray-600">Create personalized messages or use templates to send wishes via SMS or email on scheduled dates.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9l4 4-4 4M7 9l-4 4 4 4" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Contact Management</h2>
                <p class="text-gray-600">Easily add, edit, and organize contacts, and set preferences for each person to automate sending options.</p>
            </div>
        </div>

        <!-- Feature Section 2 -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Gift Tracking</h2>
                <p class="text-gray-600">Track the delivery status of sent gifts in real-time, ensuring they arrive on time and in perfect condition.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Payment Integration</h2>
                <p class="text-gray-600">Securely handle payments for gifts with integrated payment gateways, offering multiple payment options.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Multi-language Support</h2>
                <p class="text-gray-600">Cater to a global audience with multi-language support, making the platform accessible to everyone.</p>
            </div>
        </div>

        <!-- Feature Section 3 -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Wedding Gifts</h2>
                <p class="text-gray-600">Create a wedding event where guests can gift you money or regular gifts. Manage your wedding gift registry seamlessly.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Santa Claus</h2>
                <p class="text-gray-600">Kids can write their wishes to Santa, who will deliver the gifts. Parents manage and pay for the orders, ensuring a magical experience.</p>
            </div>
        </div>
    </div>
</div>
@endsection
