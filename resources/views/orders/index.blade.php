@extends('layouts.user.app')

@section('content')
<div class="bg-white">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">My Orders</h1>

        @if ($orders->isEmpty())
            <p class="mt-12 text-center text-lg font-medium text-gray-600">You have no orders yet.</p>
        @else
            <div class="mt-12 space-y-6">
                @foreach ($orders as $orderNumber => $orderGroup)
                    <div class="border p-6 rounded-lg bg-gray-50">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-600">Order Date: {{ $orderGroup->first()->created_at->format('H:i d M Y') }}</p>
                        </div>

                        <div class="mt-4 space-y-4">
                            @foreach ($orderGroup as $order)
                                <div class="flex justify-between items-center">
                                    <img src="{{ Storage::url($order->product->main_image) }}" alt="{{ $order->product->name }}" class="h-16 w-16 object-cover">

                                    <div>
                                        <p class="text-base font-medium text-gray-900">{{ $order->product->name }}</p>
                                        <p class="text-sm text-gray-600">Quantity: {{ $order->quantity }}</p>
                                    </div>

                                    <p class="text-base font-medium text-gray-900">Total: ${{ number_format($order->total, 2) }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 flex justify-between items-center font-bold">
                            <p class="text-base text-gray-900">Grand Total: ${{ number_format($orderGroup->sum('total'), 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
