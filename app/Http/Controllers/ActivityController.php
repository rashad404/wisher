<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Contact;
use App\Models\UserEvent;
use App\Models\Message;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        // Example variables
        $firstName = auth()->user()->profile->first_name; // Adjust according to your data source
        $lastName = auth()->user()->profile->last_name; // Adjust according to your data source

        // Retrieve necessary data
        $recentActivities = Activity::latest()->get();
        $contactsCount = Contact::where('user_id', auth()->id())->count();
        $eventsCount = UserEvent::where('user_id', auth()->id())->count();
        $messagesCount = Message::where('sender_id', auth()->id())->count();
        $upcomingEvents = UserEvent::where('user_id', auth()->id())->where('date', '>', now())->orderBy('date')->get();
        $recentMessages = Message::where('sender_id', auth()->id())->latest()->take(5)->get();

        return view('user.index', compact('firstName', 'lastName', 'recentActivities', 'contactsCount', 'eventsCount', 'messagesCount', 'upcomingEvents', 'recentMessages'));
    }
}
