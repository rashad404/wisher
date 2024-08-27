<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\Activity;
use Carbon\Carbon;
use App\Models\Group;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail;
use JeroenDesloovere\VCard\VCardParser;
use JeroenDesloovere\VCard\VCard;



class ContactController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Retrieve contacts based on search query or retrieve all contacts if no search query is provided, with pagination
        $contacts = Contact::query()
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone_number', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10); // Adjust the number to control how many contacts are shown per page
    
        return view('user.contacts.index', compact('contacts', 'search'));
    }
    

    public function create()
    {
        $groups = Group::where('user_id', Auth::id())->get();
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

        if ($validatedData['birth_day'] && $validatedData['birth_month'] && $validatedData['birth_year']) {
            $validatedData['birthdate'] = Carbon::createFromDate($validatedData['birth_year'], $validatedData['birth_month'], $validatedData['birth_day'])->format('Y-m-d');
        }

        unset($validatedData['birth_day'], $validatedData['birth_month'], $validatedData['birth_year']);

        $validatedData['user_id'] = Auth::id();

        $contact = Contact::create($validatedData);

        // Sync the groups
        $contact->groups()->sync($request->input('groups', []));

        // Log the activity
        Activity::create([
            'user_id' => Auth::id(),
            'type' => 'contact_added',
            'description' => "Added a new contact: {$contact->name}",
        ]);

        return redirect()->route('user.contacts.index')->with('success', 'Contact created successfully.');
    }

    public function show($id)
    {
        $contact = Contact::with(['events', 'registeredUser'])->findOrFail($id);
        return view('user.contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('user.contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone_number' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone_number = $request->input('phone_number');
        $contact->birthdate = $request->input('birthdate');

        if ($request->hasFile('photo')) {
            if ($contact->photo) {
                Storage::disk('public')->delete($contact->photo);
            }

            $path = $request->file('photo')->store('photos', 'public');
            $contact->photo = $path;
        }

        $contact->save();

        // Log the activity
        Activity::create([
            'user_id' => Auth::id(),
            'type' => 'contact_updated',
            'description' => "Updated contact: {$contact->name}",
        ]);

        return redirect()->route('user.contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        // Log the activity
        Activity::create([
            'user_id' => Auth::id(),
            'type' => 'contact_deleted',
            'description' => "Deleted contact: {$contact->name}",
        ]);

        return redirect()->route('user.contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function sendSms(Request $request, $contactId)
    {
        $contact = Contact::findOrFail($contactId);

        // Validate that the contact has a phone number
        if (!$contact->phone_number) {
            return redirect()->back()->with('error', 'This contact does not have a phone number.');
        }

        // Additional Validations
        $request->validate([
            'message' => 'required|string|max:160',
        ]);

        // Example: Check rate limiting
        $sentMessagesCount = Activity::where('user_id', auth()->id())
                                ->where('type', 'sms')
                                ->where('created_at', '>=', now()->subDay())
                                ->count();

        if ($sentMessagesCount >= 10) {
            return redirect()->back()->with('error', 'You have reached the limit of SMS messages you can send today.');
        }

        // Twilio setup
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        $message = $request->input('message'); // The message text from the request

        try {
            $twilio->messages->create($contact->phone_number, [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => $message
            ]);

            // Log the SMS activity in the database
            Activity::create([
                'user_id' => auth()->id(),
                'type' => 'sms',
                'description' => "Sent SMS to {$contact->phone_number}: {$message}",
            ]);

            return redirect()->back()->with('success', 'SMS sent successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send SMS: ' . $e->getMessage());
        }
    }

    public function sendEmail(Request $request, $contactId)
    {
        $contact = Contact::findOrFail($contactId);

        // Validate that the contact has an email address
        if (!$contact->email) {
            return redirect()->back()->with('error', 'This contact does not have an email address.');
        }

        // Additional Validations
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Example: Check rate limiting
        $sentEmailsCount = Activity::where('user_id', auth()->id())
                              ->where('type', 'email')
                              ->where('created_at', '>=', now()->subDay())
                              ->count();

        if ($sentEmailsCount >= 20) {
            return redirect()->back()->with('error', 'You have reached the limit of emails you can send today.');
        }

        $messageText = $request->input('message'); // The message text from the request

        try {
            Mail::to($contact->email)->send(new ContactMessage($contact, $messageText));

            // Log the email activity in the database
            Activity::create([
                'user_id' => auth()->id(),
                'type' => 'email',
                'description' => "Sent email to {$contact->email}: {$messageText}",
            ]);

            return redirect()->back()->with('success', 'Email sent successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function importFromIos(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'contacts_file' => 'required|file|mimetypes:text/x-vcard,text/vcard,text/plain,application/octet-stream',
        ]);
    
        // Retrieve the uploaded file
        $file = $request->file('contacts_file');
    
        // Parse the vCard file
        $parser = VCardParser::parseFromFile($file->getRealPath());
    
        $contacts = [];
    
        // Iterate through each vCard contact in the file
        foreach ($parser as $vcard) {
            // Extract full name (fallback to firstname if fullname is not present)
            $fullname = $vcard->fullname ?? trim(($vcard->firstname ?? '') . ' ' . ($vcard->lastname ?? ''));
    
            // Handle phone numbers (using the first available phone number)
            $phone_number = null;
            if (isset($vcard->phone) && is_array($vcard->phone)) {
                $firstPhoneType = array_key_first($vcard->phone);
                $phone_number = $vcard->phone[$firstPhoneType][0] ?? null;
            }
    
            // Since other fields like email, address, birthday, and photo are not in the provided structure, they will be skipped.
            // Prepare the contact data for insertion
            $contacts[] = [
                'name' => $fullname,
                'email' => null,  // Set to null since it's not present
                'phone_number' => $phone_number,
                'birthdate' => null, // Set to null since it's not present
                'address' => null,  // Set to null since it's not present
                'photo' => null,  // Set to null since it's not present
            ];
        }
    
        // Save each contact to the database
        foreach ($contacts as $contactData) {
            Contact::create([
                'user_id' => Auth::id(),
                'name' => $contactData['name'],
                'email' => $contactData['email'],
                'phone_number' => $contactData['phone_number'],
                'birthdate' => $contactData['birthdate'],
                'address' => $contactData['address'],
                'photo' => $contactData['photo'],
            ]);
        }
    
        // Redirect back with a success message
        return redirect()->route('user.contacts.index')->with('success', 'Contacts imported successfully!');
    }
    
    

}
