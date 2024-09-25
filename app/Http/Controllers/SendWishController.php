<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use App\Models\Event;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\EventCategory;

class SendWishController extends Controller
{
    public function index()
    {
        $eventCategories = EventCategory::all();
        $events = Event::all();
        $contacts = Contact::all();

        $languages = Wish::select('lang')->distinct()->get();

        $wishes = Wish::all();

        // Return the view with all necessary data
        return view('send-wish.index', compact('eventCategories', 'wishes', 'events', 'contacts', 'languages'));
    }
}
