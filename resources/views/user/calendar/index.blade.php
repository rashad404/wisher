@extends('layouts.user.app')

@section('content')

<div class="p-6">
    <x-breadcrumbs :links="[
        ['url' => route('user.index'), 'label' => 'Home'],
        ['url' => route('user.groups.index'), 'label' => 'Groups']
    ]"/>
</div>

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Your Calendar</h1>

    <!-- Date Picker Form -->
    <form method="GET" action="{{ route('user.calendar.index') }}" class="mb-6 bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Start Date -->
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#E9654B] focus:border-[#E9654B] h-12">
            </div>

            <!-- End Date -->
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#E9654B] focus:border-[#E9654B] h-12">
            </div>

            <!-- Submit Button -->
            <div class="pt-6">
                <button type="submit" class="w-full px-4 py-2 bg-[#E9654B] text-white font-semibold rounded-md shadow hover:bg-[#d14836] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E9654B] transition duration-200 h-12">
                    Filter
                </button>
            </div>
        </div>
    </form>

    <!-- Calendar Display-->
    <div class="w-full lg:w-3/5 mx-auto mb-8">
        <div id="calendar" class="bg-white shadow-lg rounded-lg p-6"></div>
    </div>

    <!-- Events List -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Events</h2>
        @if($events->isEmpty())
            <p class="text-gray-600">No events found for the selected dates.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach($events as $event)
                    <li class="py-4">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-900">{{ $event->date }} - {{ $event->name }}</span>
                            <div class="text-sm text-gray-500">
                                @if($event->is_annual)
                                    <span>(Annual)</span>
                                @endif
                                @if($event->is_monthly)
                                    <span>(Monthly)</span>
                                @endif
                            </div>
                        </div>
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
