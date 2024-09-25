<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Wish;
use App\Models\Event;
use App\Models\Group;
use App\Models\Contact;
use Twilio\Rest\Client;
use App\Models\Activity;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use JeroenDesloovere\VCard\VCardParser;
use JeroenDesloovere\VCard\VCard;
use Illuminate\Support\Facades\Storage;

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

        $eventCategories = EventCategory::all();
        $events = Event::all();

        return view('user.contacts.show', compact('contact', 'eventCategories', 'events'));
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

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        Contact::whereIn('id', $ids)->delete();
        return response()->json(['success' => true]);
    }

    public function bulkStatusUpdate(Request $request)
    {
        $ids = $request->input('ids', []);
        $newStatus = $request->input('status');
        Contact::whereIn('id', $ids)->update(['status' => $newStatus]);
        return response()->json(['success' => true]);
    }

    public function sendMessage(Request $request, $contactId)
    {
        $contact = Contact::findOrFail($contactId);

        // Validate message input
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = $request->input('message');

        if ($request->has('sendSms')) {
            return $this->sendSms($request, $contactId);
        }

        if ($request->has('sendEmail')) {
            return $this->sendEmail($request, $contactId);
        }

        return redirect()->back()->with('error', 'No message type selected.');
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

        // Twilio setup
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');

        // Debug output
        if (!$sid || !$token) {
            \Log::error('Twilio SID or Auth Token is missing.');
            return redirect()->back()->with('error', 'Twilio credentials are missing.');
        }

        // Check values
        \Log::info('Twilio SID: ' . $sid);
        \Log::info('Twilio Token: ' . $token);

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
            \Log::error('Failed to send SMS: ' . $e->getMessage());
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

        // Validate message input
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

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

    public function getEventsByCategory($categoryId)
    {
        $events = Event::where('category_id', $categoryId)->get();
        return response()->json($events);
    }

    public function loadWishMessage(Request $request)
    {
        $eventId = $request->input('event_id');

        $wish = Wish::where('event_id', $eventId)->first();

        if ($wish) {
            return response()->json(['message' => $wish->text]);
        } else {
            return response()->json(['message' => 'No message available for this event.']);
        }
    }

    public function getMessages(Request $request)
    {
        $eventId = $request->input('event_id');

        if (!$eventId) {
            return response()->json(['messages' => []]);
        }

        $messages = Wish::where('event_id', $eventId)->get(['id', 'title', 'text']);

        return response()->json(['messages' => $messages]);
    }


    // IOS import

    public function importFromIos(Request $request)
    {
        return $this->importContacts($request, 'iOS');
    }

    private function importContacts(Request $request, $source)
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
        return redirect()->route('user.contacts.index')->with('success', "Contacts imported successfully from {$source}!");
    }

    // Android import
    public function importFromAndroid(Request $request)
    {
        return $this->importContacts($request, 'Android');
    }

    // Android import CSV - OLD -not used anymore
    // public function importFromAndroid(Request $request)
    // {
    //     // Validate the uploaded file
    //     $request->validate([
    //         'contacts_file' => 'required|file|mimes:csv,txt',
    //     ]);

    //     $file = $request->file('contacts_file');
    //     $contacts = $this->parseAndroidCsv($file);

    //     // Save contacts to database
    //     foreach ($contacts as $contactData) {
    //         Contact::create(array_merge(['user_id' => Auth::id()], $contactData));
    //     }

    //     return redirect()->route('user.contacts.index')->with('success', 'Contacts imported successfully from Android!');
    // }

    // private function parseAndroidCsv($file)
    // {
    //     $contacts = [];
    //     $handle = fopen($file->getRealPath(), 'r');
    //     $headers = fgetcsv($handle); // Get the headers

    //     while (($data = fgetcsv($handle)) !== false) {
    //         $contact = [];
    //         foreach ($headers as $index => $header) {
    //             $contact[$this->sanitizeHeader($header)] = $data[$index] ?? null;
    //         }

    //         $contacts[] = [
    //             'name' => trim($contact['first_name'] . ' ' . $contact['last_name']),
    //             'email' => $contact['email_1_value'] ?? null,
    //             'phone_number' => $contact['phone_1_-_value'] ?? null,
    //             'birthdate' => $contact['birthday'] ? date('Y-m-d', strtotime($contact['birthday'])) : null,
    //             'address' => $contact['address_1_formatted'] ?? null,
    //             'photo' => null, // CSV doesn't typically include photo data
    //         ];
    //     }
    //     fclose($handle);
    //     return $contacts;
    // }

    // private function sanitizeHeader($header)
    // {
    //     return strtolower(str_replace(' ', '_', $header));
    // }

}
