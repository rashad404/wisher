<?php
namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        // Retrieve only the groups that belong to the authenticated user
        $groups = Group::where('user_id', Auth::id())->with('contacts')->get();
        return view('user.groups.index', compact('groups'));
    }

    public function create()
    {
        return view('user.groups.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validatedData['user_id'] = Auth::id();

        Group::create($validatedData);

        return redirect()->route('user.groups.index')->with('success', 'Group created successfully.');
    }

    public function show(Group $group)
    {
        // Ensure the group belongs to the authenticated user
        if ($group->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Show only the contacts belonging to this group and user
        $contacts = Contact::where('user_id', Auth::id())->get();
        return view('user.groups.show', compact('group', 'contacts'));
    }

    public function edit(Group $group)
    {
        // Ensure the group belongs to the authenticated user
        if ($group->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        // Ensure the group belongs to the authenticated user
        if ($group->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group->update($request->all());

        return redirect()->route('user.groups.index')->with('success', 'Group updated successfully.');
    }

    public function destroy(Group $group)
    {
        // Ensure the group belongs to the authenticated user
        if ($group->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $group->delete();
        return redirect()->route('user.groups.index')->with('success', 'Group deleted successfully.');
    }

    public function addContact(Request $request, Group $group)
    {
        // Ensure the group belongs to the authenticated user
        if ($group->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
        ]);

        $group->contacts()->attach($request->contact_id);

        return back()->with('success', 'Contact added to group.');
    }

    public function removeContact(Group $group, Contact $contact)
    {
        // Ensure the group belongs to the authenticated user
        if ($group->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $group->contacts()->detach($contact->id);

        return back()->with('success', 'Contact removed from group.');
    }
}
