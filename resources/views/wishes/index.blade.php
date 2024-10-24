@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <!-- Page Heading -->
    <h1 class="text-4xl font-bold text-center mb-16">{{ __('messages.wish_templates') }}</h1> <!-- Heading with margin-bottom -->

    <!-- Filter Section -->
    <div class="mb-10 flex justify-center">
        <form method="GET" action="{{ route('wishes.index') }}" class="w-full max-w-3xl space-y-4 md:space-y-0 md:space-x-4 flex flex-col md:flex-row items-center">

            <!-- Event Category Filter -->
            <div class="w-full md:w-auto">
                <label for="category_id" class="sr-only">{{ __('messages.all_categories') }}</label>
                <select name="category_id" id="category_id" class="block w-full form-select bg-white border border-gray-300 rounded-md px-4 py-2 text-gray-700 focus:ring-[#E9654B] focus:border-[#E9654B]">
                    <option value="">{{ __('messages.all_categories') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $categoryId ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Event Filter -->
            <div class="w-full md:w-auto">
                <label for="event_id" class="sr-only">{{ __('messages.all_events') }}</label>
                <select name="event_id" id="event_id" class="block w-full form-select bg-white border border-gray-300 rounded-md px-4 py-2 text-gray-700 focus:ring-[#E9654B] focus:border-[#E9654B]">
                    <option value="">{{ __('messages.all_events') }}</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ $event->id == $eventId ? 'selected' : '' }}>
                            {{ $event->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Language Filter -->
            <div class="w-full md:w-auto">
                <label for="lang" class="sr-only">Language</label>
                <select name="lang" class="block w-full form-select bg-white border border-gray-300 rounded-md px-4 py-2 text-gray-700 focus:ring-[#E9654B] focus:border-[#E9654B]">
                    <option value="az" {{ $language == 'az' ? 'selected' : '' }}>AZ</option>
                    <option value="en" {{ $language == 'en' ? 'selected' : '' }}>EN</option>
                </select>
            </div>

            <!-- Filter Button -->
            <div class="w-full md:w-auto">
                <button type="submit" class="flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-[#E9654B] hover:bg-[#d45a43] transition-colors duration-300">
                    {{ __('messages.filter') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Added extra margin between filter section and wishes cards -->
    <div class="mt-8"></div> <!-- Added extra margin to create space between filters and cards -->

    <!-- Wishes Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($wishes as $wish)
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6 hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $wish->title }}</h2>
                <p class="text-gray-600 mb-4">{{ $wish->text }}</p>
                <p class="text-sm text-gray-500">{{ __('messages.event') }}: {{ $wish->event->name }}</p>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="mt-6 flex justify-center">
        {{ $wishes->links('vendor.pagination.custom') }}
    </div>

    <!-- No Wishes Message -->
    @if($wishes->isEmpty())
        <div class="text-center text-gray-500 mt-6">
            <p>{{ __('messages.no_wishes_found') }}</p>
        </div>
    @endif
</div>

<script>
    document.getElementById('category_id').addEventListener('change', function() {
        var categoryId = this.value;
        var eventSelect = document.getElementById('event_id');

        // Make an AJAX request to get events by category or fetch all events if no category is selected
        fetch(`/events-by-category?category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                eventSelect.innerHTML = `<option value="">{{ __('messages.all_events') }}</option>`;
                data.forEach(event => {
                    eventSelect.innerHTML += `<option value="${event.id}">${event.name}</option>`;
                });
            });
    });
</script>
@endsection
