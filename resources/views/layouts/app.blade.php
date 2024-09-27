<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css?123') }}?ref={{rand(11111,99999)}}">
    <script src="{{ asset('js/app.js') }}?ref={{rand(11111,99999)}}" defer></script>
    <title>Wisher.az - Hədiyyə və Arzuların Ünvanı</title>
</head>
<body class="h-full">
    <header>
        @include('/layouts/header')
    </header>

    <nav>
        <!-- Include your navigation menu here -->
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('/layouts/footer')
    </footer>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
