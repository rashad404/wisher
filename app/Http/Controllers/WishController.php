<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Wish;
use Illuminate\Http\Request;

class WishController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all event categories for the dropdown
        $categories = EventCategory::orderBy('position')->get();

        // Get selected filters
        $categoryId = $request->get('category_id');
        $eventId = $request->get('event_id');
        $language = $request->get('lang', 'en');

        // Fetch events based on selected category
        $events = Event::where('status', 'active')
            ->when($categoryId, function($query) use ($categoryId) {
                if ($categoryId) {
                    return $query->where('category_id', $categoryId);
                }
            })
            ->orderBy('position')
            ->get();

        // Fetch wishes based on selected filters and paginate them
        $wishes = Wish::with('event')
            ->when($eventId, function($query) use ($eventId) {
                if ($eventId) {
                    return $query->where('event_id', $eventId);
                }
            })
            ->when($language, function($query) use ($language) {
                return $query->where('lang', $language);
            })
            ->paginate(9) // Adjust the number of items per page as needed
            ->appends($request->query()); // Remember the filter selections in pagination links

        return view('wishes.index', compact('categories', 'events', 'wishes', 'categoryId', 'eventId', 'language'));
    }

    public function getEventsByCategory(Request $request)
    {
        $categoryId = $request->get('category_id');

        // If no specific category is selected, return all active events
        if (!$categoryId) {
            $events = Event::where('status', 'active')->orderBy('position')->get();
        } else {
            $events = Event::where('category_id', $categoryId)->where('status', 'active')->orderBy('position')->get();
        }

        return response()->json($events);
    }
}
