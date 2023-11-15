<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Wisher.az - Hədiyyə və Arzuların Ünvanı</title>
</head>
<body class="h-full">
    <header>
        @include('/layouts/dashboard/sidebar')
        @include('/layouts/dashboard/sidebar-mobile')
        @include('/layouts/dashboard/header')
    </header>
    
    <nav>
        <!-- Include your navigation menu here -->
    </nav>
    
    <main class="ml-80">
        @yield('content')
    </main>
    
    <footer>
        @include('/layouts/dashboard/footer')
    </footer>
</body>
</html>
