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
                            @php
                                $totalSubtotal = 0;
                                $totalShipping = 0;
                                $totalTax = 0;
                                $grandTotal = 0;
                            @endphp

                            @foreach ($orderGroup as $order)
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 items-center border-b border-gray-200 pb-4">
                                    <div class="flex items-start space-x-4">
                                        <img src="{{ Storage::url($order->product->main_image) }}" alt="{{ $order->product->name }}" class="h-32 w-32 object-cover rounded-md">

                                        <div>
                                            <a href="{{ url('/products/' . $order->product->id) }}" class="text-lg font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out no-underline">
                                                {{ $order->product->name }}
                                            </a>

                                            @php
                                                $contactIds = json_decode($order->contact_ids, true) ?? [];
                                                $contactCount = max(count($contactIds), 1);
                                                $adjustedQuantity = $order->quantity * $contactCount;
                                            @endphp

                                            <p class="text-sm text-gray-500">Quantity: {{ $adjustedQuantity }}</p>

                                            <div class="mt-2">
                                                <p class="text-sm font-semibold text-indigo-700 mb-2">Purchased for:</p>
                                                <div class="flex items-center flex-wrap space-x-2">
                                                    @if (!empty($contactIds))
                                                        @foreach ($contactIds as $index => $contactId)
                                                            <a href="{{ url('/user/contacts/' . $contactId) }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out no-underline font-medium" title="View profile of {{ getProfileNameById($contactId) }}">
                                                                {{ getProfileNameById($contactId) }}
                                                            </a>
                                                            @if ($index < count($contactIds) - 1)
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

                                        @php
                                            $adjustedSubtotal = $order->product->price * $adjustedQuantity;

                                            // Calculate shipping (10% of subtotal)
                                            $adjustedShipping = $adjustedSubtotal * 0.1;

                                            // Calculate tax (7% of subtotal)
                                            $adjustedTax = $adjustedSubtotal * 0.07;

                                            $adjustedTotal = $adjustedSubtotal + $adjustedShipping + $adjustedTax;

                                            $totalSubtotal += $adjustedSubtotal;
                                            $totalShipping += $adjustedShipping;
                                            $totalTax += $adjustedTax;
                                            $grandTotal += $adjustedTotal;
                                        @endphp

                                        <p class="text-lg font-bold text-gray-900">${{ number_format($adjustedTotal, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600">Subtotal: ${{ number_format($totalSubtotal, 2) }}</p>
                                <p class="text-sm text-gray-600">Shipping: ${{ number_format($totalShipping, 2) }}</p>
                                <p class="text-sm text-gray-600">Tax: ${{ number_format($totalTax, 2) }}</p>
                            </div>
                            <p class="text-xl font-semibold text-gray-900">Grand Total: ${{ number_format($grandTotal, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

@php
function getProfileNameById($id) {
    $profile = \App\Models\Contact::find($id);
    return $profile ? $profile->name : 'Me';
}
@endphp
