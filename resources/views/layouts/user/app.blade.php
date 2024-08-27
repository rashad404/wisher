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

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops! Something went wrong.</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
    
    <footer>
        @include('/layouts/user/footer')
    </footer>
    @stack('scripts')

</body>
</html>
