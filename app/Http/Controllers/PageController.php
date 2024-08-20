<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }
    
    public function termsOfService()
    {
        return view('pages.terms-of-service');
    }
    
    public function faq()
    {
        return view('pages.faq');
    }

    public function showContactForm()
    {
        return view('pages.contact');
    }

    public function submitContactForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone-number' => 'required|string|max:15',
            'message' => 'required|string|max:1000',
        ]);

        // Send email
        Mail::send([], [], function ($message) use ($request) {
            $message->to('support@sayt.az')
                ->subject('New Contact Us Message')
                ->setBody(
                    'You have received a new message from the Contact Us form.' . "\n\n" .
                    'First Name: ' . $request->input('first-name') . "\n" .
                    'Last Name: ' . $request->input('last-name') . "\n" .
                    'Email: ' . $request->input('email') . "\n" .
                    'Phone Number: ' . $request->input('phone-number') . "\n\n" .
                    'Message: ' . "\n" . $request->input('message'),
                    'text/plain'
                );
        });

        return redirect()->route('contact.show')->with('success', 'Your message has been sent successfully!');
    }

    public function features()
    {
        return view('pages.features');
    }
}