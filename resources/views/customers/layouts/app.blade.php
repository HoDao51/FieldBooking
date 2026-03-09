<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>SânBóngPro - Đặt sân nhanh chóng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- header -->
    <div class="bg-white shadow-sm sticky top-0 z-50">
        @include('customers.layouts.header')
    </div>

    <!-- content -->
    @yield('content')

    <!-- footer -->
    <div class="bg-gray-100 py-4">
        @include('customers.layouts.footer')
    </div>
</body>
</html>
