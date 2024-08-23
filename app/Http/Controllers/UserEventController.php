<?php

namespace App\Http\Controllers;

use App\Models\UserEvent;
use App\Models\Contact;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEventController extends Controller
{
    /**
     * Display a listing of the user events.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = UserEvent::where('user_id', Auth::id())->get();
        return view('user.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new user event.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $contacts = Contact::all();
        $groups = Group::all();
        return view('user.events.create', compact('contacts', 'groups'));
    }

    /**
     * Store a newly created user event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:0,1',
            'group_id' => 'nullable|exists:groups,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'recurrence' => 'nullable|in:0,1,2', // 0->none, 1->annually, 2->monthly
        ]);

        UserEvent::create([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'recurrence' => $request->input('recurrence', 0), // Default to 0 if not provided
            'status' => $request->input('status'),
            'group_id' => $request->input('group_id'),
            'contact_id' => $request->input('contact_id'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('user.events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Show the form for editing the specified user event.
     *
     * @param  \App\Models\UserEvent  $event
     * @return \Illuminate\View\View
     */
    public function edit(UserEvent $event)
    {
        $contacts = Contact::all();
        $groups = Group::all();
        return view('user.events.edit', compact('event', 'contacts', 'groups'));
    }

    /**
     * Update the specified user event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEvent  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'recurrence' => 'nullable|in:0,1,2',
            'status' => 'required|in:0,1',
            'group_id' => 'nullable|exists:groups,id',
            'contact_id' => 'nullable|exists:contacts,id',
        ]);

        $event = UserEvent::findOrFail($id);
        $event->update([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'recurrence' => $request->input('recurrence'),
            'status' => $request->input('status'),
            'group_id' => $request->input('group_id'),
            'contact_id' => $request->input('contact_id'),
        ]);

        return redirect()->route('user.events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Display the specified user event.
     *
     * @param  \App\Models\UserEvent  $event
     * @return \Illuminate\View\View
     */
    public function show(UserEvent $event)
    {
        return view('user.events.show', compact('event'));
    }

    /**
     * Remove the specified user event from storage.
     *
     * @param  \App\Models\UserEvent  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UserEvent $event)
    {
        $event->delete();
        return redirect()->route('user.events.index')->with('success', 'Event deleted successfully.');
    }
}
