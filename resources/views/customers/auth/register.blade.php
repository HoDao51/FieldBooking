<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('customers.layouts.header')
    <div class="min-h-[calc(100vh-5rem)] grid grid-cols-2">
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
        <div class="flex items-center justify-center bg-gray-50">

            <div class="bg-white w-[420px] p-8 rounded-xl shadow">

                <h2 class="text-2xl font-bold text-center">
                    Đăng ký
                </h2>

                <p class="text-center text-gray-500 text-sm mt-1">
                    Tạo tài khoản để bắt đầu đặt sân
                </p>

                <form method="POST" action="{{ route('customer.postRegister') }}" class="mt-6 space-y-4"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Tên khách hàng -->
                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]" for="name">Họ &
                            tên</label>
                        <input type="text" value="{{ old('name') }}" name="name" id="name"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                            placeholder="Nhập họ & tên">
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- mật khẩu -->
                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]" for="password">Mật
                            khẩu</label>
                        <input type="password" value="{{ old('password') }}" name="password" id="password"
                            autocomplete="new-password"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                            placeholder="Nhập mật khẩu">
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Số điện thoại -->
                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]" for="phoneNumber">Số điện
                            thoại</label>
                        <input type="text" value="{{ old('phoneNumber') }}" name="phoneNumber" id="phoneNumber"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                            placeholder="Nhập số điện thoại">
                        @error('phoneNumber')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]" for="email">Email</label>
                        <input type="email" value="{{ old('email') }}" name="email" id="email"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                            placeholder="Nhập email">
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Avatar -->
                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]" for="avatar">Ảnh đại
                            diện</label>

                        <input type="file" value="{{ old('avatar') }}" name="avatar" id="avatar"
                            accept="image/*"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">

                        @error('avatar')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Button -->
                    <button
                        class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                        Đăng ký
                    </button>

                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Đã có tài khoản?
                    <a href="{{ route('customer.login') }}" class="text-green-600 font-semibold">
                        Đăng nhập
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
