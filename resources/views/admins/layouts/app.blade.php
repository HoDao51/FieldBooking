<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SBP - Trang quản trị</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
</head>

<body class="min-h-screen flex flex-col bg-gray-100" data-auth-id="{{ auth()->id() }}">

    <!-- header -->
    <div class="sticky top-0 z-50">
        @include('admins.layouts.navbar')
    </div>
    <!-- main -->
    <div class="flex w-full">
        <!-- sidebar -->
        <div class="fixed top-16 h-[calc(100vh-4rem)] hidden md:block">
            @include('admins.layouts.sidebar')
        </div>
        <!-- content -->
        <main class="flex-1 md:ml-72 p-6 pb-0 h-[calc(100vh-5rem)] overflow-auto">
            @yield('content')
        </main>
    </div>
</body>
@vite(['resources/js/app.js'])

</html>
