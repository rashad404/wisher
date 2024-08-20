<?php

namespace App\Http\Controllers;

use App\Models\UserEvent;
use App\Models\Contact;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
            'status' => 'required|in:active,inactive',
            'group_id' => 'nullable|exists:groups,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'recurrence' => 'nullable|in:annual,monthly',
        ]);

        // Handle the recurrence value
        $recurrence = $request->input('recurrence');
        $isAnnual = $recurrence == 'annual' ? true : false;
        $isMonthly = $recurrence == 'monthly' ? true : false;

        // Create a new UserEvent with the user_id
        UserEvent::create([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'is_annual' => $isAnnual,
            'is_monthly' => $isMonthly,
            'status' => $request->input('status'),
            'group_id' => $request->input('group_id'),
            'contact_id' => $request->input('contact_id'),
            'user_id' => auth()->id(),  // Assuming you are using Laravel's auth system
        ]);

        return redirect()->route('user.events.index')->with('success', 'Important Date created successfully.');
    }

    /**
     * Show the form for editing the specified user event.
     *
     * @param  \App\Models\UserEvent  $event
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $event = UserEvent::findOrFail($id);
        $groups = Group::all(); // Assuming you need groups for the form
        $contacts = Contact::all(); // Assuming you need contacts for the form
        return view('user.events.edit', compact('event', 'groups', 'contacts'));
    }

    /**
     * Update the specified user event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEvent  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, UserEvent $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'group_id' => 'nullable|exists:groups,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'recurrence' => 'nullable|in:annual,monthly',
        ]);

        $recurrence = $request->input('recurrence');

        // Validate that only one of the recurrence options is selected
        if ($recurrence == 'annual') {
            $isAnnual = true;
            $isMonthly = false;
        } elseif ($recurrence == 'monthly') {
            $isAnnual = false;
            $isMonthly = true;
        } else {
            $isAnnual = false;
            $isMonthly = false;
        }

        $event->update([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'is_annual' => $isAnnual,
            'is_monthly' => $isMonthly,
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
    public function show($id)
    {
        $event = UserEvent::findOrFail($id);
        $event->date = Carbon::parse($event->date); // Ensure date is a Carbon instance

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
