@extends('layouts.app')

@section('title', 'FAQ | ' . config('app.name'))

@section('content')
<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Frequently Asked Questions</h1>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">What is Wisher.az?</h2>
            <p class="text-gray-700">
                Wisher.az is a platform that helps you remember important dates and automatically sends personalized wishes and gifts to your loved ones on their special occasions.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">How does Wisher.az work?</h2>
            <p class="text-gray-700">
                Simply add your contacts, set up important dates like birthdays or anniversaries, and choose from a range of personalized messages and gifts. Wisher.az will take care of the rest, ensuring your wishes are sent on time.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Can I customize the messages and gifts?</h2>
            <p class="text-gray-700">
                Yes, you can either use our pre-made templates or customize your own messages and select gifts based on your contacts' preferences.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Is there a free trial available?</h2>
            <p class="text-gray-700">
                Yes, we offer a 14-day free trial that gives you full access to all the features of Wisher.az. No credit card is required to start the trial.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">How do I manage my contacts?</h2>
            <p class="text-gray-700">
                You can add, edit, or delete contacts directly from your dashboard. You can also organize contacts into groups for easier management.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">How secure is my information?</h2>
            <p class="text-gray-700">
                We take your privacy seriously. All data is encrypted and stored securely. We do not share your information with third parties without your consent.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Can I cancel my subscription at any time?</h2>
            <p class="text-gray-700">
                Yes, you can cancel your subscription at any time through your account settings. Your account will remain active until the end of the current billing cycle.
            </p>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">How do I contact customer support?</h2>
            <p class="text-gray-700">
                You can reach our customer support team via email at <a href="mailto:support@wisher.az" class="text-indigo-500 hover:text-indigo-700">support@wisher.az</a>. We’re here to help you with any questions or issues you may have.
            </p>
        </div>
    </div>
</div>
@endsection