<?php
 
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('user.contacts.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new contact
        // You can add validation rules as needed
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone_number' => 'nullable',
            'birthdate' => 'nullable|date',
            'address' => 'nullable',
            'interests' => 'nullable|array',
            'likes' => 'nullable|array',
            'dislikes' => 'nullable|array',
        ]);

        // Use the authenticated user's ID
        $data['user_id'] = Auth::id();
        Contact::create($data);

        return redirect()->route('user.contacts');
    }

    public function show(Contact $contact)
    {
        return view('user.contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('user.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        // Validate and update the contact
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone_number' => 'nullable',
            'birthdate' => 'nullable|date',
            'address' => 'nullable',
            'interests' => 'nullable|array',
            'likes' => 'nullable|array',
            'dislikes' => 'nullable|array',
        ]);

        $contact->update($data);


        return redirect()->route('user.contacts');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('user.contacts');
    }
}
