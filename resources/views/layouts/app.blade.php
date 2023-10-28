<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Your App Title</title>
    <!-- Include your CSS and JavaScript assets here -->
</head>
<body>
    <header>
        @include('/layouts/header')
    </header>
    
    <nav>
        <!-- Include your navigation menu here -->
    </nav>
    
    <main>
        @yield('content') <!-- This is where the content of each page will be inserted -->
    </main>
    
    <footer>
        @include('/layouts/footer')
    </footer>
</body>
</html>
