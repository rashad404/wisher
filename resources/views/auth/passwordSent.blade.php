@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="{{ asset('images/logo-w.svg') }}" alt="Wisher.az">
        <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Password Reset Link Sent</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="text-center text-lg text-gray-900">
            <p>Parolunuzu sıfırlamaq üçün sizə e-poçt linki göndərdik. Zəhmət olmasa, gələnlər qutusunu yoxlayın.</p>
        </div>
    </div>
</div>
@endsection
