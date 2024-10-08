<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use App\Models\Event;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Conversation;
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
            'sendVia' => 'required|array|min:1',
            'sendVia.*' => 'in:sms,email,chat',
        ]);

        $message = $request->input('message');
        $contactIds = $request->input('contacts');
        $sendVia = $request->input('sendVia');

        \Log::info('Sending message', ['message' => $message, 'contacts' => $contactIds, 'sendVia' => $sendVia]);

        $messageSent = false;

        foreach ($contactIds as $contactId) {
            $contact = Contact::find($contactId);

            \Log::info('Processing contact', ['contact_id' => $contactId, 'contact' => $contact]);

            try {
                if (in_array('sms', $sendVia)) {
                    $this->sendSms($message, $contact->phone_number);
                }

                if (in_array('email', $sendVia)) {
                    $this->sendEmail($message, $contact->email);
                }

                if (in_array('chat', $sendVia)) {
                    $this->sendChatMessage($message, $contactId);
                }

                $messageSent = true;
            } catch (\Exception $e) {
                \Log::error('Error sending message', ['contact_id' => $contactId, 'error' => $e->getMessage()]);
            }
        }

        if ($messageSent) {
            return redirect()->back()->with('status', 'Message sent successfully!');
        } else {
            return redirect()->back()->with('error', 'No messages were sent. Please try again.');
        }
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
