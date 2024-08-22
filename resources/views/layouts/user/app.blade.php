<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css?123') }}">
    <title>Wisher.az - Hədiyyə və Arzuların Ünvanı</title>
</head>
<body class="h-full bg-gray-500 bg-opacity-25">
    <header>
        @include('/layouts/user/sidebar')
        @include('/layouts/user/sidebar-mobile')
        @include('/layouts/user/header')
    </header>
    
    <nav>
        <!-- Include your navigation menu here -->
    </nav>
    
    <main class="min-h-full mr-4 my-4 lg:ml-[304px] p-12 transform divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5">
        @yield('content')
    </main>
    
    <footer>
        @include('/layouts/user/footer')
    </footer>
    @stack('scripts')

</body>
</html>
