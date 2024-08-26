<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $messageText;

    public function __construct($contact, $messageText)
    {
        $this->contact = $contact;
        $this->messageText = $messageText;
    }

    public function build()
    {
        return $this->subject('A message from ' . config('app.name'))
                    ->view('emails.contact_message')
                    ->with([
                        'contact' => $this->contact,
                        'messageText' => $this->messageText,
                    ]);
    }
}
