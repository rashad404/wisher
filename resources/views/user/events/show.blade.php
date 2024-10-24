@extends('layouts.user.app')

@section('content')

<!-- Breadcrumbs -->
<div class="py-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.events.index'), 'label' => 'Events'],
        ['url' => route('user.events.show', $event->id), 'label' => $event->name],
    ]"/>
</div>

<!-- Event Details Container -->
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-lg bg-white rounded-lg shadow-lg">
        <!-- Event Name and Date -->
        <div class="p-6 text-center border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900">{{ $event->name }}</h2>
            <p class="mt-2 text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }} -
                {{ $event->is_annual ? 'Annually' : ($event->is_monthly ? 'Monthly' : 'No Recurrence') }}
            </p>
        </div>

        <!-- Event Info -->
        <div class="p-6 space-y-4">
            <!-- Recurrence -->
            <div class="flex justify-between items-center text-gray-700">
                <span class="font-semibold">Recurrence</span>
                <span class="text-gray-500">{{ $event->is_annual ? 'Annually' : ($event->is_monthly ? 'Monthly' : 'No Recurrence') }}</span>
            </div>

            <!-- Status -->
            <div class="flex justify-between items-center text-gray-700">
                <span class="font-semibold">Status</span>
                <span class="text-gray-500">{{ $event->status ? 'Active' : 'Inactive' }}</span>
            </div>

            <!-- Group -->
            <div class="flex justify-between items-center text-gray-700">
                <span class="font-semibold">Group</span>
                <span class="text-gray-500">{{ $event->group->name ?? 'No Group' }}</span>
            </div>

            <!-- Contact -->
            <div class="flex justify-between items-center text-gray-700">
                <span class="font-semibold">Contact</span>
                <span class="text-gray-500">{{ $event->contact->name ?? 'No Contact' }}</span>
            </div>
        </div>

        <!-- Back Button -->
        <div class="p-6 border-t border-gray-200">
            <div class="flex justify-center">
                <button type="button" onclick="window.history.back()" class="inline-flex items-center px-4 py-2 bg-[#E9654B] text-white font-semibold rounded-md shadow hover:bg-[#e65b39] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E9654B]">
                    Back
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
