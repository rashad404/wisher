<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Group;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactEventController extends Controller
{
    public function index(Contact $contact)
    {
        $events = $contact->events()->where('user_id', auth()->id())->get();
        $groups = Group::all(); // Fetch all groups
        return view('user.contacts.events', compact('contact', 'events', 'groups'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'recurrence' => 'required|in:0,1,2',
            'status' => 'required|in:active,inactive',
            'contact_id' => 'required|exists:contacts,id',
        ]);

        $event = new UserEvent();
        $event->name = $validatedData['name'];
        $event->date = $validatedData['date'];
        $event->recurrence = $validatedData['recurrence'];
        $event->status = $validatedData['status'];
        $event->contact_id = $validatedData['contact_id'];
        $event->user_id = Auth::id();

        $event->save();

        return redirect()->route('contacts.events.index', $event->contact_id)
            ->with('success', 'Event added successfully!');
    }

    public function show($contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $groups = Group::all();
        $events = UserEvent::where('contact_id', $contactId)->get();

        $events->each(function ($event) {
            $event->date = \Carbon\Carbon::parse($event->date);
        });

        return view('user.contacts.events.index', compact('contact', 'groups', 'events'));
    }

    public function destroy(Contact $contact, $eventId)
    {
        $event = $contact->events()->where('user_id', auth()->id())->findOrFail($eventId);
        $event->delete();

        return redirect()->route('contacts.events.index', $contact->id);
    }

}
