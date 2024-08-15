@extends('layouts.app')

@section('title', 'Terms of Service | ' . config('app.name'))

@section('content')
<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Terms of Service</h1>
        <p class="mb-6 text-gray-700">
            Welcome to {{ config('app.name') }}. By using our website and services, you agree to comply with and be bound by the following terms and conditions of use.
        </p>
        
        <h2 class="text-xl font-bold text-gray-800 mb-4">1. Acceptance of Terms</h2>
        <p class="mb-6 text-gray-700">
            By accessing or using our website, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.
        </p>
        
        <h2 class="text-xl font-bold text-gray-800 mb-4">2. Use of Services</h2>
        <p class="mb-6 text-gray-700">
            You agree to use our services only for lawful purposes and in a manner that does not infringe the rights of, restrict, or inhibit anyone else's use and enjoyment of the services.
        </p>

        <h2 class="text-xl font-bold text-gray-800 mb-4">3. User Accounts</h2>
        <p class="mb-6 text-gray-700">
            When you create an account with us, you must provide accurate and complete information. You are responsible for maintaining the confidentiality of your account and password.
        </p>

        <h2 class="text-xl font-bold text-gray-800 mb-4">4. Intellectual Property</h2>
        <p class="mb-6 text-gray-700">
            All content included on our website, such as text, graphics, logos, and images, is the property of {{ config('app.name') }} or its content suppliers and is protected by intellectual property laws.
        </p>

        <h2 class="text-xl font-bold text-gray-800 mb-4">5. Termination</h2>
        <p class="mb-6 text-gray-700">
            We may terminate or suspend your account and bar access to the service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.
        </p>

        <h2 class="text-xl font-bold text-gray-800 mb-4">6. Limitation of Liability</h2>
        <p class="mb-6 text-gray-700">
            In no event shall {{ config('app.name') }}, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages.
        </p>

        <h2 class="text-xl font-bold text-gray-800 mb-4">7. Governing Law</h2>
        <p class="mb-6 text-gray-700">
            These Terms shall be governed and construed in accordance with the laws of the jurisdiction in which {{ config('app.name') }} operates, without regard to its conflict of law provisions.
        </p>

        <h2 class="text-xl font-bold text-gray-800 mb-4">8. Changes to Terms</h2>
        <p class="mb-6 text-gray-700">
            We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect.
        </p>

        <h2 class="text-xl font-bold text-gray-800 mb-4">9. Contact Us</h2>
        <p class="mb-6 text-gray-700">
            If you have any questions about these Terms, please contact us at <a href="mailto:support@wisher.az" class="text-indigo-500 hover:text-indigo-700">support@wisher.az</a>.
        </p>
    </div>
</div>
@endsection