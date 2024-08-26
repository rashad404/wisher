<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Group;
use App\Models\UserEvent;
use Illuminate\Http\Request;


class ContactEventController extends Controller
{
    public function index(Contact $contact)
    {
        $events = $contact->events()->where('user_id', auth()->id())->get();
        $groups = Group::all(); // Fetch all groups
        return view('user.contacts.events', compact('contact', 'events', 'groups'));
    }

    public function store(Request $request, Contact $contact)
    {
        // Validate and store the event
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'recurrence' => 'nullable|string',
            'status' => 'required|string',
            'group_id' => 'nullable|exists:groups,id',
            'contact_id' => 'required|exists:contacts,id',
        ]);

        // Add user_id to the validated data
        $validated['user_id'] = auth()->id();

        // Create the event
        $contact->events()->create($validated);

        return redirect()->route('contacts.events.index', $contact->id);
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
