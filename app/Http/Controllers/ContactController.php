<?php
 
namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
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
    
        Contact::create($validatedData);
    
        return redirect()->route('user.contacts.index')->with('success', 'Contact created successfully.');
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
