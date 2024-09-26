<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use App\Models\Event;
use App\Models\Contact;
use App\Models\Message; // Add this import
use App\Models\Conversation; // Add this import
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Auth;

class SendWishController extends Controller
{
    public function index()
    {
        $eventCategories = EventCategory::all();
        $events = Event::all();
        $contacts = Contact::all();
        $languages = Wish::select('lang')->distinct()->get();
        $wishes = Wish::all();

        return view('send-wish.index', compact('eventCategories', 'wishes', 'events', 'contacts', 'languages'));
    }

    public function sendWish(Request $request)
    {
        // Validate the input
        $request->validate([
            'message' => 'required|string',
            'contacts' => 'required|array',
            'contacts.*' => 'exists:contacts,id',
        ]);

        $message = $request->input('message');
        $contactIds = $request->input('contacts');

        // Log the received message and contacts for debugging
        \Log::info('Sending message', ['message' => $message, 'contacts' => $contactIds]);

        foreach ($contactIds as $contactId) {
            $contact = Contact::find($contactId);

            // Log the contact being processed
            \Log::info('Processing contact', ['contact_id' => $contactId, 'contact' => $contact]);

            if ($request->has('sendSms')) {
                $this->sendSms($message, $contact->phone_number);
            }

            if ($request->has('sendEmail')) {
                $this->sendEmail($message, $contact->email);
            }

            if ($request->has('sendChat')) {
                $this->sendChatMessage($message, $contactId); // Call the chat function
            }
        }

        return redirect()->back()->with('success', 'Messages sent successfully!');
    }

    // Function to send SMS via Twilio
    protected function sendSms($message, $toNumber)
    {
        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_TOKEN');
        $twilioNumber = env('TWILIO_FROM');

        $client = new Client($accountSid, $authToken);
        $client->messages->create($toNumber, [
            'from' => $twilioNumber,
            'body' => $message
        ]);
    }

    // Function to send Email
    protected function sendEmail($message, $toEmail)
    {
        \Mail::raw($message, function ($mail) use ($toEmail) {
            $mail->from('your-email@example.com');
            $mail->to($toEmail)
                ->subject('Wish Message');
        });
    }

    // Function to send a chat message
    protected function sendChatMessage($messageContent, $contactId)
    {
        // Find or create a conversation with the contact
        $conversation = Conversation::firstOrCreate(
            [
                'user1_id' => Auth::id(),
                'user2_id' => $contactId,
            ],
            [
                'user1_id' => Auth::id(),
                'user2_id' => $contactId,
            ]
        );

        // Create a new message in that conversation
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'body' => $messageContent,
            'is_seen' => false,
        ]);
    }
}
