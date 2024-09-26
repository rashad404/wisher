<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use App\Models\Event;
use App\Models\Contact;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Models\EventCategory;

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

    public function sendMessage(Request $request)
    {
        // Validate the input
        $request->validate([
            'message' => 'required|string',
            'contacts' => 'required|array', // Ensure contacts are selected
            'contacts.*' => 'exists:contacts,id', // Validate that each contact exists
        ]);

        $message = $request->input('message');
        $contactIds = $request->input('contacts'); // Selected contacts

        // Loop through each contact and send the message based on the selected methods
        foreach ($contactIds as $contactId) {
            $contact = Contact::find($contactId); // Retrieve the contact

            if ($request->has('sendSms')) {
                $this->sendSms($message, $contact->phone_number); // Pass contact phone number
            }

            if ($request->has('sendEmail')) {
                $this->sendEmail($message, $contact->email); // Pass contact email
            }

            if ($request->has('sendChat')) {
                $this->sendChat($message, $contact->chat_id); // Pass contact's chat ID
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

    // Function to send message via Twilio Chat
    protected function sendChat($message, $chatId)
    {
        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_TOKEN');
        $chatServiceSid = env('TWILIO_CHAT_SERVICE_SID');

        $client = new Client($accountSid, $authToken);

        $client->chat->v2->services($chatServiceSid)
            ->channels($chatId) // Use the contact-specific chat ID
            ->messages
            ->create([
                'body' => $message
            ]);
    }
}
