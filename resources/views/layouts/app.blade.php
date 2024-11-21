<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Include Navbar -->
        @include('components.navbar')

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Include Footer -->
        @include('components.footer')
    </div>
</body>
</html>
