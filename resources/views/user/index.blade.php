@extends('layouts.user.app')

@section('content')
<div class="py-6">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
        Welcome, {{ $firstName }} {{ $lastName }}
    </h2>
    <p class="mt-1 text-sm text-gray-600">Here's what's happening today on Wisher.az</p>
</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Quick Actions -->
    <div class="bg-white shadow sm:rounded-lg border-l-4 border-[#E9654B] hover:border-[#d45a43] transition duration-300">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900 flex items-center">
                <svg class="h-5 w-5 text-[#E9654B] mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="10"></circle>
                </svg>
                Quick Actions
            </h3>
            <div class="mt-5">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <!-- Add New Contact Button -->
                    <a href="{{ route('user.contacts.create') }}" class="flex items-center justify-center rounded-md bg-[#E9654B] px-4 py-3 text-white font-semibold hover:bg-[#d45a43] transition duration-300 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Add New Contact
                    </a>

                    <!-- Create Event Button with darker hover effect -->
                    <a href="{{ route('user.events.create') }}" class="flex items-center justify-center rounded-md bg-yellow-500 px-4 py-3 text-white font-semibold hover:bg-yellow-600 transition duration-300 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Create Event
                    </a>

                    <!-- View Calendar Button with darker hover effect -->
                    <a href="{{ route('user.calendar.index') }}" class="flex items-center justify-center rounded-md bg-green-500 px-4 py-3 text-white font-semibold hover:bg-green-600 transition duration-300 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                        View Calendar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white shadow sm:rounded-lg border-l-4 border-[#4F46E5] hover:border-[#3730A3] transition duration-300 col-span-2">
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

    <!-- Stats Overview with Progress Bars -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Stats Overview</h3>
            <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="bg-indigo-50 p-4 rounded-lg text-center shadow-sm">
                    <div class="text-2xl font-bold text-[#4F46E5]">{{ $contactsCount }}</div>
                    <div class="text-sm text-gray-500">Contacts</div>
                    <div class="relative pt-1">
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                            <div style="width: {{ ($contactsCount / 100) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-[#E9654B]"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-indigo-50 p-4 rounded-lg text-center shadow-sm">
                    <div class="text-2xl font-bold text-[#4F46E5]">{{ $eventsCount }}</div>
                    <div class="text-sm text-gray-500">Events</div>
                    <div class="relative pt-1">
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                            <div style="width: {{ ($eventsCount / 100) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-[#E9654B]"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-indigo-50 p-4 rounded-lg text-center shadow-sm">
                    <div class="text-2xl font-bold text-[#4F46E5]">{{ $messagesCount }}</div>
                    <div class="text-sm text-gray-500">Messages</div>
                    <div class="relative pt-1">
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                            <div style="width: {{ ($messagesCount / 100) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-[#E9654B]"></div>
                        </div>
                    </div>
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
                            <a href="{{ route('user.events.show', $event->id) }}" class="text-sm font-semibold text-[#E9654B] hover:text-[#d45a43] transition duration-300">View Details</a>
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
