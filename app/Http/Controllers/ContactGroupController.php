<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactGroupController extends Controller
{
    public function index(Contact $contact)
    {
        $groups = $contact->groups;
        $allGroups = Group::all();
        return view('user.contacts.groups', compact('contact', 'groups', 'allGroups'));
    }

    public function create(Contact $contact)
    {
        $allGroups = Group::all();
        return view('contacts.groups', compact('contact', 'allGroups'));
    }

    public function store(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'group_id' => 'required|exists:groups,id',
        ]);

        if ($contact->groups()->where('group_id', $validatedData['group_id'])->exists()) {
            return redirect()->back()->withErrors(['group_id' => 'This group is already associated with the contact.']);
        }

        $contact->groups()->attach($validatedData['group_id']);

        return redirect()->route('contacts.groups.index', $contact->id)
            ->with('success', 'Group added successfully!');
    }
    public function show(Contact $contact, $groupId)
    {
        $group = Group::findOrFail($groupId);
        $allGroups = Group::all();
        return view('contacts.groups', compact('contact', 'group', 'allGroups'));
    }

    public function edit(Contact $contact, $groupId)
    {
        $group = Group::findOrFail($groupId);
        $allGroups = Group::all();
        return view('contacts.groups', compact('contact', 'group', 'allGroups'));
    }

    public function update(Request $request, Contact $contact, $groupId)
    {
        $validatedData = $request->validate([
            'group_id' => 'required|exists:groups,id',
        ]);

        $contact->groups()->detach($groupId);
        $contact->groups()->attach($validatedData['group_id']);

        return redirect()->route('contacts.groups.index', $contact->id)
            ->with('success', 'Group updated successfully!');
    }

    public function destroy(Contact $contact, $groupId)
    {
        $contact->groups()->detach($groupId);

        return redirect()->route('contacts.groups.index', $contact->id)
            ->with('success', 'Group removed successfully!');
    }
}
