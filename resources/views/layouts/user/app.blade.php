<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Heroicon link -->
    <link href="https://unpkg.com/heroicons@1.0.5/dist/heroicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css?123') }}">
    <title>Wisher.az - Hədiyyə və Arzuların Ünvanı</title>
</head>
<body class="h-full bg-gray-50">
    <header>
        @include('/layouts/user/sidebar')
        @include('/layouts/user/sidebar-mobile')
        @include('/layouts/user/header')
    </header>

    <nav>
        <!-- Include your navigation menu here -->
    </nav>

    <main class="min-h-full mr-4 my-4 lg:ml-[304px] p-12 divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-xl ring-1 ring-black ring-opacity-5">
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops! Something went wrong.</strong>
                <ul class="mt-2 list-disc list-inside">
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
