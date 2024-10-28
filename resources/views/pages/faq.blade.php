@extends('layouts.app')

@section('title', 'FAQ | ' . config('app.name'))

@section('content')
<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- FAQ Title with extra spacing below -->
        <h1 class="text-4xl font-extrabold text-gray-900 text-center mb-12">Frequently Asked Questions</h1>

        <!-- Add some margin to move FAQ content a little lower -->
        <div class="mt-8 space-y-6">
            <!-- FAQ Items - Accordion Style -->
            <div class="space-y-6">

                <!-- FAQ 1 -->
                <div class="border-b border-gray-300">
                    <button class="w-full text-left focus:outline-none" aria-expanded="false">
                        <h2 class="text-xl font-semibold text-gray-800 py-4 flex justify-between items-center">
                            What is Wisher.az?
                            <!-- Arrow in orange color -->
                            <span class="ml-2 text-[#E9654B] transition-transform transform rotate-0">&#x25bc;</span>
                        </h2>
                    </button>
                    <div class="hidden mt-2 text-gray-700">
                        <p>
                            Wisher.az is a platform that helps you remember important dates and automatically sends personalized wishes and gifts to your loved ones on their special occasions.
                        </p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border-b border-gray-300">
                    <button class="w-full text-left focus:outline-none" aria-expanded="false">
                        <h2 class="text-xl font-semibold text-gray-800 py-4 flex justify-between items-center">
                            How does Wisher.az work?
                            <span class="ml-2 text-[#E9654B] transition-transform transform rotate-0">&#x25bc;</span>
                        </h2>
                    </button>
                    <div class="hidden mt-2 text-gray-700">
                        <p>
                            Simply add your contacts, set up important dates like birthdays or anniversaries, and choose from a range of personalized messages and gifts. Wisher.az will take care of the rest, ensuring your wishes are sent on time.
                        </p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border-b border-gray-300">
                    <button class="w-full text-left focus:outline-none" aria-expanded="false">
                        <h2 class="text-xl font-semibold text-gray-800 py-4 flex justify-between items-center">
                            Can I customize the messages and gifts?
                            <span class="ml-2 text-[#E9654B] transition-transform transform rotate-0">&#x25bc;</span>
                        </h2>
                    </button>
                    <div class="hidden mt-2 text-gray-700">
                        <p>
                            Yes, you can either use our pre-made templates or customize your own messages and select gifts based on your contacts' preferences.
                        </p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border-b border-gray-300">
                    <button class="w-full text-left focus:outline-none" aria-expanded="false">
                        <h2 class="text-xl font-semibold text-gray-800 py-4 flex justify-between items-center">
                            Is there a free trial available?
                            <span class="ml-2 text-[#E9654B] transition-transform transform rotate-0">&#x25bc;</span>
                        </h2>
                    </button>
                    <div class="hidden mt-2 text-gray-700">
                        <p>
                            Yes, we offer a 14-day free trial that gives you full access to all the features of Wisher.az. No credit card is required to start the trial.
                        </p>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="border-b border-gray-300">
                    <button class="w-full text-left focus:outline-none" aria-expanded="false">
                        <h2 class="text-xl font-semibold text-gray-800 py-4 flex justify-between items-center">
                            How do I manage my contacts?
                            <span class="ml-2 text-[#E9654B] transition-transform transform rotate-0">&#x25bc;</span>
                        </h2>
                    </button>
                    <div class="hidden mt-2 text-gray-700">
                        <p>
                            You can add, edit, or delete contacts directly from your dashboard. You can also organize contacts into groups for easier management.
                        </p>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="border-b border-gray-300">
                    <button class="w-full text-left focus:outline-none" aria-expanded="false">
                        <h2 class="text-xl font-semibold text-gray-800 py-4 flex justify-between items-center">
                            How secure is my information?
                            <span class="ml-2 text-[#E9654B] transition-transform transform rotate-0">&#x25bc;</span>
                        </h2>
                    </button>
                    <div class="hidden mt-2 text-gray-700">
                        <p>
                            We take your privacy seriously. All data is encrypted and stored securely. We do not share your information with third parties without your consent.
                        </p>
                    </div>
                </div>

                <!-- FAQ 7 -->
                <div class="border-b border-gray-300">
                    <button class="w-full text-left focus:outline-none" aria-expanded="false">
                        <h2 class="text-xl font-semibold text-gray-800 py-4 flex justify-between items-center">
                            Can I cancel my subscription at any time?
                            <span class="ml-2 text-[#E9654B] transition-transform transform rotate-0">&#x25bc;</span>
                        </h2>
                    </button>
                    <div class="hidden mt-2 text-gray-700">
                        <p>
                            Yes, you can cancel your subscription at any time through your account settings. Your account will remain active until the end of the current billing cycle.
                        </p>
                    </div>
                </div>

                <!-- FAQ 8 -->
                <div class="border-b border-gray-300">
                    <button class="w-full text-left focus:outline-none" aria-expanded="false">
                        <h2 class="text-xl font-semibold text-gray-800 py-4 flex justify-between items-center">
                            How do I contact customer support?
                            <span class="ml-2 text-[#E9654B] transition-transform transform rotate-0">&#x25bc;</span>
                        </h2>
                    </button>
                    <div class="hidden mt-2 text-gray-700">
                        <p>
                            You can reach our customer support team via email at <a href="mailto:support@wisher.az" class="text-red-500 hover:text-red-700">support@wisher.az</a>. We’re here to help you with any questions or issues you may have.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action for Further Support -->
        <div class="mt-12 text-center">
            <p class="text-lg text-gray-600">
                Didn't find your answer?
                <a href="/contact" class="text-red-500 hover:text-red-700 font-semibold underline">Contact our support team</a>
                and we’ll be happy to assist you!
            </p>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('button[aria-expanded]').forEach(button => {
        button.addEventListener('click', () => {
            const expanded = button.getAttribute('aria-expanded') === 'true' || false;

            // Toggle the aria-expanded attribute
            button.setAttribute('aria-expanded', !expanded);

            // Toggle the rotation of the icon
            button.querySelector('span').classList.toggle('rotate-180');

            // Toggle the visibility of the next sibling (the answer)
            const answer = button.nextElementSibling;
            if (!expanded) {
                answer.classList.remove('hidden');
                answer.classList.add('block');
            } else {
                answer.classList.remove('block');
                answer.classList.add('hidden');
            }
        });
    });
</script>
@endsection
