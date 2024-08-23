@extends('layouts.user.app')

@section('content')


<div class="py-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.events.index'), 'label' => 'Events'],
        ['url' => route('user.events.show', $event->id), 'label' => $event->name],
    ]"/>
</div>

<div class="flex justify-center h-screen">

    <div class="w-full max-w-lg flex-none flex-col divide-y divide-gray-100">
        <div class="flex-none p-6 text-center">
            <h2 class="mt-3 text-lg font-semibold text-gray-900">{{ $event->name }}</h2>
            <p class="text-sm leading-6 text-gray-500">
                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }} -
                {{ $event->is_annual ? 'Annually' : ($event->is_monthly ? 'Monthly' : 'No Recurrence') }}
            </p>
        </div>
        <div class="flex flex-auto flex-col justify-between p-6">
            <div class="space-y-4">
                <div class="flex justify-between text-sm text-gray-700">
                    <span class="font-semibold text-gray-900">Recurrence</span>
                    <span>
                        {{ $event->is_annual ? 'Annually' : ($event->is_monthly ? 'Monthly' : 'No Recurrence') }}
                    </span>
                </div>
                <div class="flex justify-between text-sm text-gray-700">
                    <span class="font-semibold text-gray-900">Status</span>
                    <span>{{ $event->status ?: 'No Status' }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-700">
                    <span class="font-semibold text-gray-900">Group</span>
                    <span>{{ $event->group->name ?? 'No Group' }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-700">
                    <span class="font-semibold text-gray-900">Contact</span>
                    <span>{{ $event->contact->name ?? 'No Contact' }}</span>
                </div>
            </div>
            <div class="mt-6 flex gap-6 justify-center">
                <button type="button" onclick="window.history.back()" class="w-32 rounded-md bg-gray-300 px-4 py-2 text-sm font-semibold text-gray-900 shadow-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">Back</button>
            </div>
        </div>
    </div>
</div>
@endsection
