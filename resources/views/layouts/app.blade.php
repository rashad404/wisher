<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</body>
</html>
