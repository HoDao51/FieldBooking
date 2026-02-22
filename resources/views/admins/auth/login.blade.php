<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập quản trị - SânBóngPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-green-800 to-green-600 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">

        <!-- Logo -->
        <div class="text-center mb-6">
            <div class="flex items-center justify-center gap-2 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <g stroke-linecap="round" stroke-linejoin="round">
                        <path d="M.75 3.75h22.5v16.5H.75zm11.25 0v16.5" />
                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0-6 0" />
                        <path d="M.75 8.25h3a1.5 1.5 0 0 1 1.5 1.5v4.5a1.5 1.5 0 0 1-1.5 1.5h-3" />
                        <path d="M22.5 8.25h-3a1.5 1.5 0 0 0-1.5 1.5v4.5a1.5 1.5 0 0 0 1.5 1.5h3" />
                    </g>
                </svg>
                <span class="text-xl font-semibold">
                    SânBóng<span class="font-bold text-gray-800">Pro</span>
                </span>
            </div>

            <p class="text-sm text-gray-500 mt-2">
                Trang quản trị hệ thống
            </p>
        </div>

        <!-- Title -->
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">
            Đăng nhập quản trị
        </h2>

        <!-- Form -->
        <form action="{{ route('postLogin') }}" method="POST" autocomplete="off"
            class="grid grid-flow-row auto-rows-min gap-3 space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label for="email"
                    class="pt-0 label label-text font-semibold text-[#1f2937]"><span>Email</span></label>
                <div class="flex-1 relative border border-gray-200 rounded-md">
                    <input id="email" name="email" type="text" placeholder="Địa chỉ email"
                        value="{{ old('email') }}" autocomplete="off"
                        class="w-full pl-10 pt-3 pb-3 bg-transparent focus:outline-none focus:ring-1 focus:ring-green-400">
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
                        class="w-full pl-10 pt-3 pb-3 bg-transparent focus:outline-none focus:ring-1 focus:ring-green-400">
                    <svg class="inline w-5 h-5 absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 pointer-events-none"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg font-semibold transition">
                Đăng nhập
            </button>

        </form>

        <!-- Footer -->
        <p class="text-xs text-gray-400 text-center mt-6">
            © 2026 SânBóngPro - Hệ thống quản lý sân bóng
        </p>

    </div>

</body>

</html>
