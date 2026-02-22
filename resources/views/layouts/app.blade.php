<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RSCEP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col">

    <!-- header -->
    <div class="sticky top-0 z-50">
        @include('layouts.navbar')
    </div>

    <!-- main -->
    <div class="flex flex-1 w-full">
        <div class="fixed top-18 left-0 h-screen z-40 hidden md:block">
            @include('layouts.sidebar')
        </div>
        <main class="flex-1 h-full pl-3 bg-gray-100 overflow-auto pr-6 pt-2 md:ml-60">
            @yield('content')
        </main>
    </div>

    <!-- FOOTER -->
    <footer class="hidden lg:block font-semibold text-gray-500 uppercase py-4 ml-[250px] border-t mt-6 mr-6">
        @include('layouts.footer')
    </footer>
</body>
</html>