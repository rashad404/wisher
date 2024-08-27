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
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Retrieve contacts based on search query or retrieve all contacts if no search query is provided
        $contacts = Contact::query()
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone_number', 'like', '%' . $search . '%');
                });
            })
            ->get();

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

    private function sendSms(Request $request, $contactId)
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

    private function sendEmail(Request $request, $contactId)
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

    public function sendMessage(Request $request, $contactId)
    {
        $contact = Contact::findOrFail($contactId);

        // Validate the message field
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $request->input('message'); // The message text from the request
        $errors = [];
        $successMessages = [];

        // Check if 'sendSms' checkbox is checked
        if ($request->has('sendSms')) {
            // Validate that the contact has a phone number
            if (!$contact->phone_number) {
                $errors[] = 'This contact does not have a phone number.';
            } else {
                // SMS sending logic
                try {
                    $this->sendSms($request, $contactId);
                    $successMessages[] = 'SMS sent successfully.';
                } catch (\Exception $e) {
                    $errors[] = 'Failed to send SMS: ' . $e->getMessage();
                }
            }
        }

        // Check if 'sendEmail' checkbox is checked
        if ($request->has('sendEmail')) {
            // Validate that the contact has an email address
            if (!$contact->email) {
                $errors[] = 'This contact does not have an email address.';
            } else {
                // Email sending logic
                try {
                    $this->sendEmail($request, $contactId);
                    $successMessages[] = 'Email sent successfully.';
                } catch (\Exception $e) {
                    $errors[] = 'Failed to send email: ' . $e->getMessage();
                }
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        return redirect()->back()->with('success', implode(' ', $successMessages));
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

}
