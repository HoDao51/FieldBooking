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

            <div class="bg-white w-[420px] px-8 py-4 my-6 rounded-xl shadow">

                <h2 class="text-2xl font-bold text-center">
                    Đăng ký
                </h2>

                <p class="text-center text-gray-500 text-sm mt-1">
                    Tạo tài khoản để bắt đầu đặt sân
                </p>

                <form method="POST" action="{{ route('customer.postRegister') }}" class="space-y-4"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Tên khách hàng -->
                    <div>
                        <label class="label label-text font-semibold text-[#1f2937]" for="name">Họ &
                            tên</label>
                        <div class="flex-1 relative border border-gray-300 rounded">
                            <input type="text" value="{{ old('name') }}" name="name" id="name"
                                class="w-full pl-10 pt-2.5 pb-2.5 bg-transparent focus:outline-none rounded focus:ring-1 focus:ring-green-400"
                                placeholder="Nhập họ & tên">
                            <svg class="inline w-5 h-5 absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 pointer-events-none"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- mật khẩu -->
                    <div>
                        <label class="label label-text font-semibold text-[#1f2937]" for="password">Mật
                            khẩu</label>
                        <div class="flex-1 relative border border-gray-300 rounded">
                            <input type="password" value="{{ old('password') }}" name="password" id="password"
                                autocomplete="new-password"
                                class="w-full pl-10 pt-2.5 pb-2.5 bg-transparent focus:outline-none rounded focus:ring-1 focus:ring-green-400"
                                placeholder="Nhập mật khẩu">
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

                    <!-- Số điện thoại -->
                    <div>
                        <label class="label label-text font-semibold text-[#1f2937]" for="phoneNumber">Số điện
                            thoại</label>
                        <div class="flex-1 relative border border-gray-300 rounded">
                            <input type="text" value="{{ old('phoneNumber') }}" name="phoneNumber"
                                id="phoneNumber"
                                class="w-full pl-10 pt-2.5 pb-2.5 bg-transparent focus:outline-none rounded focus:ring-1 focus:ring-green-400"
                                placeholder="Nhập số điện thoại">
                            <svg class="inline w-5 h-5 absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 pointer-events-none"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="0">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M5.733 2.043c1.217-1.21 3.221-.995 4.24.367l1.262 1.684c.83 1.108.756 2.656-.229 3.635l-.238.238a.65.65 0 0 0-.008.306c.063.408.404 1.272 1.832 2.692s2.298 1.76 2.712 1.824a.7.7 0 0 0 .315-.009l.408-.406c.876-.87 2.22-1.033 3.304-.444l1.91 1.04c1.637.888 2.05 3.112.71 4.445l-1.421 1.412c-.448.445-1.05.816-1.784.885c-1.81.169-6.027-.047-10.46-4.454c-4.137-4.114-4.931-7.702-5.032-9.47l.749-.042l-.749.042c-.05-.894.372-1.65.91-2.184zm3.04 1.266c-.507-.677-1.451-.731-1.983-.202l-1.57 1.56c-.33.328-.488.69-.468 1.036c.08 1.405.72 4.642 4.592 8.492c4.062 4.038 7.813 4.159 9.263 4.023c.296-.027.59-.181.865-.454l1.42-1.413c.578-.574.451-1.62-.367-2.064l-1.91-1.039c-.528-.286-1.146-.192-1.53.19l-.455.453l-.53-.532c.53.532.529.533.528.533l-.001.002l-.003.003l-.007.006l-.015.014a1 1 0 0 1-.136.106c-.08.053-.186.112-.319.161c-.27.101-.628.155-1.07.087c-.867-.133-2.016-.724-3.543-2.242c-1.526-1.518-2.122-2.66-2.256-3.526c-.069-.442-.014-.8.088-1.07a1.5 1.5 0 0 1 .238-.42l.032-.035l.014-.015l.006-.006l.003-.003l.002-.002l.53.53l-.53-.531l.288-.285c.428-.427.488-1.134.085-1.673z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        @error('phoneNumber')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="label label-text font-semibold text-[#1f2937]" for="email">Email</label>
                        <div class="flex-1 relative border border-gray-300 rounded">
                            <input type="email" value="{{ old('email') }}" name="email" id="email"
                                class="w-full pl-10 pt-2.5 pb-2.5 bg-transparent focus:outline-none rounded focus:ring-1 focus:ring-green-400"
                                placeholder="Nhập email">
                            <svg class="inline w-5 h-5 absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 pointer-events-none"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="0">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="m4.2 5.2l7.56 5.67a.4.4 0 0 0 .48 0L19.8 5.2zm16.6.75l-7.84 5.88a1.6 1.6 0 0 1-1.92 0L3.2 5.95V18.8h17.6zM3 4h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1" />
                            </svg>
                        </div>
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Avatar -->
                    <div>
                        <label class="label label-text font-semibold text-[#1f2937]" for="avatar">Ảnh đại
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
