<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Group;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        // Retrieve all contacts
        $contacts = Contact::all();

        return view('user.contacts.index', compact('contacts'));
    }

    public function create()
    {
        // Retrieve the groups that belong to the authenticated user
        $groups = Group::where('user_id', Auth::id())->get();
        //dd($groups);
        return view('user.contacts.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'nullable|email|min:5|max:255',
            'phone_number' => 'nullable|string|min:7|max:13',
            'birth_day' => 'required_with:birth_month,birth_year|nullable|numeric|min:1|max:31',
            'birth_month' => 'required_with:birth_day,birth_year|nullable|numeric|min:1|max:12',
            'birth_year' => 'required_with:birth_day,birth_month|nullable|numeric|min:1950|max:' . date('Y'),
            'address' => 'nullable|string|max:500',
        ]);

        // Combine birthdate fields if all are present
        if ($validatedData['birth_day'] && $validatedData['birth_month'] && $validatedData['birth_year']) {
            $validatedData['birthdate'] = Carbon::createFromDate($validatedData['birth_year'], $validatedData['birth_month'], $validatedData['birth_day'])->format('Y-m-d');
        }

        // Remove individual birthdate fields
        unset($validatedData['birth_day'], $validatedData['birth_month'], $validatedData['birth_year']);

        $validatedData['user_id'] = Auth::id();

        $contact = Contact::create($validatedData);

        // Sync the groups
        $contact->groups()->sync($request->input('groups', [])); // Ensure groups are synced

        return redirect()->route('user.contacts.index')->with('success', 'Contact created successfully.');
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        return view('user.contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('user.contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);


        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone_number' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,gif|max:10240',
        ]);

        // Update contact details
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone_number = $request->input('phone_number');
        $contact->birthdate = $request->input('birthdate');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($contact->photo) {
                Storage::delete($contact->photo);
            }

            // Store new photo and update contact model
            $path = $request->file('photo')->store('photos', 'public');
            $contact->photo = $path;
        }

        $contact->save();

        return redirect()->route('user.contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('user.contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
