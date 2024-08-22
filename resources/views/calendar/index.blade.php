@extends('layouts.user.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Your Calendar</h1>

    <!-- Date Picker Form -->
    <form method="GET" action="{{ route('calendar.index') }}" class="mb-6">
        <div class="flex items-center space-x-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Filter</button>
            </div>
        </div>
    </form>

    <!-- Calendar Display -->
    <div class="w-full lg:w-3/5 mx-auto" id="calendar-container">
        <div id="calendar"></div>
    </div>

    <!-- Events List (Optional) -->
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-xl font-semibold mb-4">Events</h2>
        @if($events->isEmpty())
            <p class="text-gray-600">No events found for the selected dates.</p>
        @else
            <ul>
                @foreach($events as $event)
                    <li class="mb-2">
                        <span class="font-semibold">{{ $event->date }}</span> - {{ $event->name }}
                        @if($event->is_annual)
                            <span class="text-sm text-gray-500">(Annual)</span>
                        @endif
                        @if($event->is_monthly)
                            <span class="text-sm text-gray-500">(Monthly)</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection


@push('scripts')
<script>
    // Array of events for FullCalendar
    var calendarEvents = [
        @foreach($events as $event)
        {
            title: '{{ $event->name }}',
            start: '{{ $event->date }}',
            allDay: true
        },
        @endforeach
    ];

    // Initialize FullCalendar when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            events: calendarEvents,
        });
        calendar.render();
    });
</script>
<script src="{{ mix('js/app.js') }}"></script>
@endpush
