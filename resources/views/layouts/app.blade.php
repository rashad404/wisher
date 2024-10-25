<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisher.az - {{ __('Your Wishes, Our Priority') }}</title>
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('head')
</head>
<body class="h-full bg-gray-50">
    @include('layouts.header')

    <main class="container mx-auto py-8 px-6">
        @yield('content')
    </main>

    @include('layouts.footer')

    @stack('scripts')
</body>
</html>
