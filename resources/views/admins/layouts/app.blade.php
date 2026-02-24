<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SBP - Trang quản trị</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col" data-auth-id="{{ auth()->id() }}">

    <!-- header -->
    <div class="sticky top-0 z-50">
        @include('admins.layouts.navbar')
    </div>

    <!-- main -->
    <div class="flex flex-1 w-full">

        <!-- sidebar -->
        <div class="hidden md:block">
            @include('admins.layouts.sidebar')
        </div>

        <!-- content -->
        <main class="flex-1 bg-gray-100 overflow-auto p-6">
            @yield('content')
        </main>

    </div>
</body>
@vite(['resources/js/app.js'])
</html>