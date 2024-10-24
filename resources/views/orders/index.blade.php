@extends('layouts.user.app')

@section('content')
<x-resource-index
    :title="'My Orders'"
    :subtitle="'Your order history'"
    :createRoute="null"
    :searchRoute="route('orders.index')"
    :items="$orders"
>
    <x-slot name="breadcrumbs">
        <x-breadcrumbs :links="[
            ['url' => route('user.index'), 'label' => 'Home'],
            ['url' => route('orders.index'), 'label' => 'My Orders'],
        ]"/>
    </x-slot>

    <!-- Orders List -->
    <x-slot name="list">
        @forelse ($orders as $orderNumber => $orderGroup)
            <li class="hover:bg-gray-50 transition duration-300 ease-in-out mb-6"> <!-- Added mb-6 for spacing, removed border -->
                <div class="px-4 py-4 sm:px-6 flex items-center justify-between bg-white shadow-sm rounded-md"> <!-- Removed border-b class -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Order #{{ $orderNumber }}</h2>
                        <p class="text-sm text-gray-500">Placed on: {{ $orderGroup->first()->created_at->format('H:i d M Y') }}</p>
                    </div>

                    <!-- Grand Total -->
                    @php
                        $totalSubtotal = 0;
                        $totalShipping = 0;
                        $totalTax = 0;
                        $grandTotal = 0;
                    @endphp

                    @foreach ($orderGroup as $order)
                        @php
                            $contactIds = json_decode($order->contact_ids, true) ?? [];
                            $contactCount = max(count($contactIds), 1);
                            $adjustedQuantity = $order->quantity * $contactCount;

                            $adjustedSubtotal = $order->product->price * $adjustedQuantity;
                            $adjustedShipping = $adjustedSubtotal * 0.1;
                            $adjustedTax = $adjustedSubtotal * 0.07;
                            $adjustedTotal = $adjustedSubtotal + $adjustedShipping + $adjustedTax;

                            $totalSubtotal += $adjustedSubtotal;
                            $totalShipping += $adjustedShipping;
                            $totalTax += $adjustedTax;
                            $grandTotal += $adjustedTotal;
                        @endphp
                    @endforeach

                    <p class="text-lg font-bold text-gray-900">Total: ${{ number_format($grandTotal, 2) }}</p>
                </div>

                <!-- Products in Order -->
                @foreach ($orderGroup as $order)
                    <div class="flex items-center justify-between p-4 sm:px-6 hover:bg-gray-100 transition duration-300">
                        <div class="flex items-center space-x-4">
                            <img src="{{ Storage::url($order->product->main_image) }}" alt="{{ $order->product->name }}" class="h-16 w-16 object-cover rounded-md">
                            <div>
                                <a href="{{ url('/products/' . $order->product->id) }}" class="text-lg font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                                    {{ $order->product->name }}
                                </a>
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
                        <p class="text-lg font-semibold text-gray-900">${{ number_format($adjustedTotal, 2) }}</p>
                    </div>
                @endforeach

                <!-- Summary -->
                <div class="px-4 py-4 sm:px-6 flex justify-between items-center bg-gray-50 rounded-md"> <!-- Removed border-b class and added rounded-md for better spacing -->
                    <div class="text-sm text-gray-600">
                        <p>Subtotal: ${{ number_format($totalSubtotal, 2) }}</p>
                        <p>Shipping: ${{ number_format($totalShipping, 2) }}</p>
                        <p>Tax: ${{ number_format($totalTax, 2) }}</p>
                    </div>
                    <p class="text-xl font-semibold text-gray-900">Grand Total: ${{ number_format($grandTotal, 2) }}</p>
                </div>
            </li>
        @empty
            <li class="px-4 py-4 sm:px-6 text-center text-gray-500">
                No orders found.
            </li>
        @endforelse
    </x-slot>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</x-resource-index>

@endsection

@php
function getProfileNameById($id) {
    $profile = \App\Models\Contact::find($id);
    return $profile ? $profile->name : 'Me';
}
@endphp
