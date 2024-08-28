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

        if (!$contact->phone_number) {
            return false; // Indicate failure
        }

        $request->validate([
            'message' => 'required|string|max:160',
        ]);

        $sentMessagesCount = Activity::where('user_id', auth()->id())
                                     ->where('type', 'sms')
                                     ->where('created_at', '>=', now()->subDay())
                                     ->count();

        if ($sentMessagesCount >= 10) {
            return false; // Indicate failure
        }

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        $message = $request->input('message');

        try {
            $twilio->messages->create($contact->phone_number, [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => $message
            ]);

            Activity::create([
                'user_id' => auth()->id(),
                'type' => 'sms',
                'description' => "Sent SMS to {$contact->phone_number}: {$message}",
            ]);

            return true; // Indicate success
        } catch (\Exception $e) {
            return false; // Indicate failure
        }
    }

    private function sendEmail(Request $request, $contactId)
    {
        $contact = Contact::findOrFail($contactId);

        if (!$contact->email) {
            return false; // Indicate failure
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $sentEmailsCount = Activity::where('user_id', auth()->id())
                                  ->where('type', 'email')
                                  ->where('created_at', '>=', now()->subDay())
                                  ->count();

        if ($sentEmailsCount >= 20) {
            return false; // Indicate failure
        }

        $messageText = $request->input('message');

        try {
            Mail::to($contact->email)->send(new ContactMessage($contact, $messageText));

            Activity::create([
                'user_id' => auth()->id(),
                'type' => 'email',
                'description' => "Sent email to {$contact->email}: {$messageText}",
            ]);

            return true; // Indicate success
        } catch (\Exception $e) {
            return false; // Indicate failure
        }
    }


    public function sendMessage(Request $request, $contactId)
    {
        $contact = Contact::findOrFail($contactId);

        // Validate the message field
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $request->input('message');
        $smsSent = false;
        $emailSent = false;
        $chatInitiated = false;

        // Handle SMS
        if ($request->input('sendSms') === '1') {
            $smsSent = $this->sendSms($request, $contactId);
        }

        // Handle Email
        if ($request->input('sendEmail') === '1') {
            $emailSent = $this->sendEmail($request, $contactId);
        }

        // Handle Chat
        if ($request->input('sendChat') === '1') {
            if ($contact->registered_user_id) {
                $chatInitiated = $this->chatWithUser($contact->registered_user_id);
            } else {
                return redirect()->back()->with('error', 'This contact is not linked to a registered user for chat.');
            }
        }

        // Determine success or error based on what was processed
        if ($smsSent || $emailSent || $chatInitiated) {
            return redirect()->back()->with('success', 'Message sent successfully.');
        } else {
            return redirect()->back()->with('error', 'No communication channel selected.');
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
}
