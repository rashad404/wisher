@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold text-center mb-6">{{ __('messages.wish_templates') }}</h1>

    <!-- Filter Section -->
    <div class="mb-6 flex justify-center">
        <form method="GET" action="{{ route('wishes.index') }}" class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
            <!-- Event Category Filter -->
            <select name="category_id" id="category_id" class="form-select bg-white border rounded px-4 py-2">
                <option value="">{{ __('messages.all_categories') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $categoryId ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- Event Filter -->
            <select name="event_id" id="event_id" class="form-select bg-white border rounded px-4 py-2">
                <option value="">{{ __('messages.all_events') }}</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ $event->id == $eventId ? 'selected' : '' }}>
                        {{ $event->name }}
                    </option>
                @endforeach
            </select>

            <!-- Language Filter -->
            <select name="lang" class="form-select bg-white border rounded py-2">
                <option value="az" {{ $language == 'az' ? 'selected' : '' }}>AZ</option>
                <option value="en" {{ $language == 'en' ? 'selected' : '' }}>EN</option>
            </select>

            <!-- Filter Button -->
            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">
                {{ __('messages.filter') }}
            </button>
        </form>
    </div>

    <!-- Wishes Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($wishes as $wish)
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2">{{ $wish->title }}</h2>
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
