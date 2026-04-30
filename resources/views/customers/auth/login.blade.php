<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css'])
</head>

<body>
    @include('customers.layouts.header')
    <div class="min-h-[calc(100vh-3.6rem)] grid grid-cols-2">
        <!-- LEFT -->
        <div class="text-white flex flex-col justify-center px-20 relative bg-cover bg-center "
            style="background-image: url('{{ asset('images/hinh-nen-san-bong-4k-4.jpg') }}');">
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-green-700/70"></div>
            <div class="relative z-10">
                <a href="{{ route('san.index') }}">
                    <div class="flex items-center mb-6">
                        <!-- Icon -->
                        <div class="pr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <g stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M.75 3.75h22.5v16.5H.75zm11.25 0v16.5" />
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0-6 0" />
                                    <path d="M.75 8.25h3a1.5 1.5 0 0 1 1.5 1.5v4.5a1.5 1.5 0 0 1-1.5 1.5h-3" />
                                    <path d="M22.5 8.25h-3a1.5 1.5 0 0 0-1.5 1.5v4.5a1.5 1.5 0 0 0 1.5 1.5h3" />
                                </g>
                            </svg>
                        </div>

                        <!-- Text -->
                        <div class="leading-tight">
                            <div class="text-[20px] font-semibold leading-5">
                                SânBóng<span class="text-gray-300 font-bold">Pro</span>
                            </div>
                        </div>
                    </div>
                </a>

                <h1 class="text-4xl font-bold leading-tight">
                    Đặt sân bóng <br>
                    <span class="text-green-300"> nhanh chóng</span> <br>
                    & tiện lợi
                </h1>

                <p class="mt-6 text-green-100">
                    Tham gia cùng hơn 50,000+ người chơi bóng đá.
                    Tìm sân, đặt lịch và thanh toán chỉ trong vài giây.
                </p>

                <ul class="mt-6 space-y-2 text-green-100">
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8z" />
                        </svg>
                        Đặt sân 24/7, mọi lúc mọi nơi
                    </li>
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8z" />
                        </svg>
                        Thanh toán an toàn, bảo mật
                    </li>
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8z" />
                        </svg>
                        Hỗ trợ khách hàng tận tình
                    </li>
                </ul>
            </div>
        </div>


        <!-- RIGHT -->
        <div class="flex items-center justify-center bg-gray-100">

            <div class="bg-white w-[420px] p-8 rounded-xl shadow">

                <h2 class="text-2xl font-bold text-center">
                    Đăng nhập
                </h2>

                <p class="text-center text-gray-500 text-sm mt-1">
                    Vui lòng đăng nhập để sử dụng hệ thống.
                </p>

                <form method="POST" action="{{ route('customer.postLogin') }}" class="mt-6 space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email"
                            class="pt-0 label label-text font-semibold text-[#1f2937]"><span>Email</span></label>
                        <div class="flex-1 relative border border-gray-200 rounded-md">
                            <input id="email" name="email" type="text" placeholder="Địa chỉ email"
                                value="{{ old('email') }}" autocomplete="off"
                                class="w-full pl-10 pt-3 pb-3 rounded bg-transparent focus:outline-none focus:ring-1 focus:ring-green-400">
                            <svg class="inline w-5 h-5 absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 pointer-events-none"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mật khẩu -->
                    <div>
                        <label for="password" class="pt-0 label label-text font-semibold text-[#1f2937]"><span>Mật
                                khẩu</span></label>
                        <div class="flex-1 relative border border-gray-200 rounded-md">
                            <input id="password" name="password" type="password" placeholder="Mật khẩu"
                                autocomplete="new-password"
                                class="w-full pl-10 pt-3 pb-3 rounded bg-transparent focus:outline-none focus:ring-1 focus:ring-green-400">
                            <svg class="inline w-5 h-5 absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 pointer-events-none"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Button -->
                    <button
                        class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                        Đăng nhập
                    </button>

                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Chưa có tài khoản?
                    <a href="{{ route('customer.register') }}" class="text-green-600 font-semibold">
                        Đăng ký ngay
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
