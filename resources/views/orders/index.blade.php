@extends('layouts.user.app')

@section('content')
<div class="bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">My Orders</h1>

        @if ($orders->isEmpty())
            <p class="mt-12 text-center text-lg font-medium text-gray-600">You have no orders yet.</p>
        @else
            <div class="mt-12 space-y-12">
                @foreach ($orders as $orderNumber => $orderGroup)
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">Order #{{ $orderNumber }}</h2>
                                <p class="text-sm text-gray-500">Placed on: {{ $orderGroup->first()->created_at->format('H:i d M Y') }}</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            @foreach ($orderGroup as $order)
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 items-center border-b border-gray-200 pb-4">
                                    <div class="flex items-start space-x-4">
                                        <img src="{{ Storage::url($order->product->main_image) }}" alt="{{ $order->product->name }}" class="h-32 w-32 object-cover rounded-md">

                                        <div>
                                            <p class="text-lg font-medium text-gray-900">{{ $order->product->name }}</p>
                                            <p class="text-sm text-gray-500">Quantity: {{ $order->quantity }}</p>

                                            <!-- Improved "Purchased for" section with horizontal layout and refined styling -->
                                            <div class="mt-2">
                                                <p class="text-sm font-semibold text-indigo-700 mb-2">Purchased for:</p>
                                                <div class="flex items-center flex-wrap space-x-2">
                                                    @php
                                                        $contactIds = is_array($order->contact_ids) ? $order->contact_ids : json_decode($order->contact_ids, true);
                                                    @endphp
                                                    @if (!empty($contactIds))
                                                        @foreach ($contactIds as $index => $contactId)
                                                            <span class="text-sm text-gray-800">{{ getProfileNameById($contactId) }}</span>
                                                            @if ($index < count($contactIds) - 1)
                                                                <!-- Subtle separator using dot instead of pipe -->
                                                                <span class="text-gray-400">&bull;</span>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <span class="text-sm text-gray-800">Me</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center sm:text-right">
                                        <p class="text-sm text-gray-500">Total:</p>
                                        <p class="text-lg font-bold text-gray-900">${{ number_format($order->total, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                            <p class="text-xl font-semibold text-gray-900">Grand Total: ${{ number_format($orderGroup->sum('total'), 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

@php
// Function to get profile name by ID
function getProfileNameById($id) {
    $profile = \App\Models\Contact::find($id);
    return $profile ? $profile->name: 'Me'; // Return 'Me' if profile is not found
}
@endphp
