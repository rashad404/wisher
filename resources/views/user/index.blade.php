@extends('layouts.user.app')

@section('content')
<div class="py-6">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Welcome, {{ $firstName }} {{ $lastName }}</h2>
    <p class="mt-1 text-sm text-gray-600">Here's what's happening today on Wisher.az</p>
</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Quick Actions -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Quick Actions</h3>
            <div class="mt-5">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <a href="{{ route('user.contacts.create') }}" class="flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">
                        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 5.25a6.75 6.75 0 110 13.5 6.75 6.75 0 010-13.5zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M12 9.75a.75.75 0 01.75.75v1.5h1.5a.75.75 0 110 1.5h-1.5v1.5a.75.75 0 01-1.5 0v-1.5h-1.5a.75.75 0 110-1.5h1.5v-1.5A.75.75 0 0112 9.75z" clip-rule="evenodd"/>
                        </svg>
                        Add New Contact
                    </a>
                    <a href="{{ route('user.events.create') }}" class="flex items-center justify-center rounded-md bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-400">
                        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3.75 7.5A1.5 1.5 0 015.25 6h13.5a1.5 1.5 0 011.5 1.5v13.5a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V7.5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 2.25v2.25m7.5-2.25v2.25"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 10.5h16.5"/>
                        </svg>
                        Create Event
                    </a>
                    <a href="{{ route('user.calendar.index') }}" class="flex items-center justify-center rounded-md bg-green-500 px-4 py-2 text-white hover:bg-green-400">
                        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.25 3v2.25m7.5-2.25v2.25M3 7.5h18M4.5 10.5h15M4.5 14.25h15M4.5 18h15M9.75 10.5v7.5M14.25 10.5v7.5"/>
                        </svg>
                        View Calendar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white shadow sm:rounded-lg col-span-2">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Recent Activity</h3>
            <div class="mt-3 text-sm text-gray-600">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($recentActivities as $activity)
                    <li class="py-4">
                        <div class="flex space-x-3">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $activity->description }}</p>
                                <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Stats Overview</h3>
            <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="bg-indigo-50 p-4 rounded-lg text-center">
                    <div class="text-2xl font-bold text-indigo-700">{{ $contactsCount }}</div>
                    <div class="text-sm text-gray-500">Contacts</div>
                </div>
                <div class="bg-indigo-50 p-4 rounded-lg text-center">
                    <div class="text-2xl font-bold text-indigo-700">{{ $eventsCount }}</div>
                    <div class="text-sm text-gray-500">Events</div>
                </div>
                <div class="bg-indigo-50 p-4 rounded-lg text-center">
                    <div class="text-2xl font-bold text-indigo-700">{{ $messagesCount }}</div>
                    <div class="text-sm text-gray-500">Messages</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="bg-white shadow sm:rounded-lg col-span-2 lg:col-span-3">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Upcoming Events</h3>
            <div class="mt-3 text-sm text-gray-600">
                @if($upcomingEvents->isEmpty())
                    <p class="text-gray-500">No upcoming events.</p>
                @else
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($upcomingEvents as $event)
                        <li class="py-4 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $event->name }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                            </div>
                            <a href="{{ route('user.events.show', $event->id) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-900">View Details</a>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="bg-white shadow sm:rounded-lg col-span-2 lg:col-span-3">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Recent Messages</h3>
            <div class="mt-3 text-sm text-gray-600">
                @if($recentMessages->isEmpty())
                    <p class="text-gray-500">No recent messages.</p>
                @else
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($recentMessages as $message)
                        <li class="py-4">
                            <div class="flex space-x-3">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $message->content }}</p>
                                    <p class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
