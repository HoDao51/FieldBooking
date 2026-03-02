<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>SânBóngPro - Đặt sân nhanh chóng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- ================= HEADER ================= -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="">
                <div class="flex items-center">
                    <!-- Icon -->
                    <div class="text-green-600 pr-2 ">
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
                        <div class="text-[20px] font-semibold text-green-600 leading-5">
                            SânBóng<span class="text-gray-800 font-bold">Pro</span>
                        </div>
                    </div>
                </div>
            </a>

            <div class="hidden md:flex w-1/3">
                <input type="text" placeholder="Tìm kiếm sân bóng theo tên, địa điểm..."
                    class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>

            <div class="flex items-center gap-4">
                <a href="#" class="text-gray-600 hover:text-green-600">Đăng nhập</a>
                <a href="#" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    Đăng ký
                </a>
            </div>
        </div>
    </header>


    <!-- ================= HERO ================= -->
    <section class="relative bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1508098682722-e99c43a406b2');">

        <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-green-700/70"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-32 text-white">

            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                Đặt sân bóng <br>
                <span class="text-green-400">nhanh chóng & dễ dàng</span>
            </h1>

            <p class="text-lg text-gray-200 mb-8 max-w-xl">
                Tìm sân, chọn giờ và thanh toán chỉ trong vài phút.
                Trải nghiệm đặt sân thông minh cùng SânBóngPro.
            </p>

            <!-- Search Box -->
            <div class="bg-white text-gray-600 rounded-xl shadow-xl p-6 max-w-4xl">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <select class="border p-3 rounded-lg focus:ring-2 focus:ring-green-600">
                        <option>Chọn tỉnh thành</option>
                    </select>

                    <select class="border p-3 rounded-lg focus:ring-2 focus:ring-green-600">
                        <option>Tất cả loại sân</option>
                    </select>

                    <input type="date" class="border p-3 rounded-lg focus:ring-2 focus:ring-green-600">

                    <button class="bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                        Tìm sân ngay
                    </button>

                </div>
            </div>

            <!-- Stats -->
            <div class="flex gap-10 mt-12">
                <div>
                    <h2 class="text-3xl font-bold">500+</h2>
                    <p class="text-gray-300">Sân bóng</p>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">10K+</h2>
                    <p class="text-gray-300">Lượt đặt</p>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">63</h2>
                    <p class="text-gray-300">Tỉnh thành</p>
                </div>
            </div>

        </div>
    </section>


    <!-- ================= FEATURED ================= -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold">Sân nổi bật</h2>
                    <p class="text-gray-500">Những sân được đặt nhiều nhất tuần này</p>
                </div>
                <a href="#" class="text-green-600 font-semibold hover:underline">
                    Xem tất cả →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($fields as $field)
                    <div
                        class="bg-white rounded-xl shadow 
                    hover:shadow-xl hover:-translate-y-1 
                    transition duration-300 ease-in-out 
                    group">

                        <!-- Ảnh -->
                        <div class="overflow-hidden rounded-t-xl">
                            <img src="{{ asset('storage/' . $field->images->first()->name) }}"
                                class="h-48 w-full object-cover 
                            transition duration-500 
                            group-hover:scale-110">
                        </div>

                        <div class="p-5">
                            <!-- Tên sân -->
                            <h3
                                class="font-semibold text-lg 
                           transition duration-300 
                           group-hover:text-green-600">
                                {{ $field->name }}
                            </h3>

                            <div class="space-y-2 mt-2">
                                <div class="flex items-start gap-2 text-gray-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4 text-green-600 mt-0.5 shrink-0" viewBox="0 0 256 256"
                                        stroke="currentColor" stroke-width="3">
                                        <path fill="currentColor"
                                            d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                                    </svg>
                                    <span>{{ $field->address }}</span>
                                </div>

                                <div class="flex items-start gap-2 text-gray-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4 text-green-600 mt-0.5 shrink-0" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="0">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5">
                                            <path
                                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M16 3.128a4 4 0 0 1 0 7.744M22 21v-2a4 4 0 0 0-3-3.87" />
                                            <circle cx="9" cy="7" r="4" />
                                        </g>
                                    </svg>
                                    <span>{{ $field->fieldType->name }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between mt-4">
                                <span class="text-yellow-500">
                                    ⭐⭐⭐⭐⭐
                                </span>

                                <a href="#"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg 
                              hover:bg-green-700 transition">
                                    Đặt ngay
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ================= CTA ================= -->
    <section class="bg-green-600 py-16 text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Sẵn sàng đặt sân ngay hôm nay?</h2>
        <p class="mb-6">Tham gia cộng đồng đam mê bóng đá lớn nhất Việt Nam.</p>
        <a href="#"
            class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
            Đăng ký miễn phí
        </a>
    </section>


    <!-- ================= FOOTER ================= -->
    <footer class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">

            <div>
                <h3 class="text-xl font-bold text-green-600 mb-4">SânBóngPro</h3>
                <p class="text-gray-600 text-sm">
                    Nền tảng đặt sân bóng đá trực tuyến hàng đầu Việt Nam.
                    Kết nối đam mê, thỏa sức tranh tài.
                </p>
            </div>

            <div>
                <h4 class="font-semibold mb-4">Liên kết nhanh</h4>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li><a href="#" class="hover:text-green-600 hover:ml-3">Trang chủ</a></li>
                    <li><a href="#" class="hover:text-green-600 hover:ml-3">Danh sách sân</a></li>
                    <li><a href="#" class="hover:text-green-600 hover:ml-3">Hướng dẫn đặt sân</a></li>
                    <li><a href="#" class="hover:text-green-600 hover:ml-3">Tin tức & Sự kiện</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-4">Hỗ trợ</h4>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li><a href="#" class="hover:text-green-600 hover:ml-3">Trung tâm trợ giúp</a></li>
                    <li><a href="#" class="hover:text-green-600 hover:ml-3">Chính sách bảo mật</a></li>
                    <li><a href="#" class="hover:text-green-600 hover:ml-3">Điều khoản sử dụng</a></li>
                    <li><a href="#" class="hover:text-green-600 hover:ml-3">Câu hỏi thường gặp</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-4">Liên hệ</h4>
                <div class="space-y-2 text-gray-600 text-sm">

                    <!-- Địa chỉ -->
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600 mt-0.5 shrink-0"
                            viewBox="0 0 256 256" stroke="currentColor" stroke-width="3">
                            <path fill="currentColor"
                                d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                        </svg>
                        <span>123 yên thường, phù đổng, Hà nội</span>
                    </div>

                    <!-- Điện thoại -->
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600 mt-0.5 shrink-0"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="0">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M5.733 2.043c1.217-1.21 3.221-.995 4.24.367l1.262 1.684c.83 1.108.756 2.656-.229 3.635l-.238.238a.65.65 0 0 0-.008.306c.063.408.404 1.272 1.832 2.692s2.298 1.76 2.712 1.824a.7.7 0 0 0 .315-.009l.408-.406c.876-.87 2.22-1.033 3.304-.444l1.91 1.04c1.637.888 2.05 3.112.71 4.445l-1.421 1.412c-.448.445-1.05.816-1.784.885c-1.81.169-6.027-.047-10.46-4.454c-4.137-4.114-4.931-7.702-5.032-9.47l.749-.042l-.749.042c-.05-.894.372-1.65.91-2.184zm3.04 1.266c-.507-.677-1.451-.731-1.983-.202l-1.57 1.56c-.33.328-.488.69-.468 1.036c.08 1.405.72 4.642 4.592 8.492c4.062 4.038 7.813 4.159 9.263 4.023c.296-.027.59-.181.865-.454l1.42-1.413c.578-.574.451-1.62-.367-2.064l-1.91-1.039c-.528-.286-1.146-.192-1.53.19l-.455.453l-.53-.532c.53.532.529.533.528.533l-.001.002l-.003.003l-.007.006l-.015.014a1 1 0 0 1-.136.106c-.08.053-.186.112-.319.161c-.27.101-.628.155-1.07.087c-.867-.133-2.016-.724-3.543-2.242c-1.526-1.518-2.122-2.66-2.256-3.526c-.069-.442-.014-.8.088-1.07a1.5 1.5 0 0 1 .238-.42l.032-.035l.014-.015l.006-.006l.003-.003l.002-.002l.53.53l-.53-.531l.288-.285c.428-.427.488-1.134.085-1.673z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>1900 12345678</span>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600 mt-0.5 shrink-0"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="0">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="m4.2 5.2l7.56 5.67a.4.4 0 0 0 .48 0L19.8 5.2zm16.6.75l-7.84 5.88a1.6 1.6 0 0 1-1.92 0L3.2 5.95V18.8h17.6zM3 4h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1" />
                        </svg>
                        <span>contact@sanbongpro.com</span>
                    </div>

                </div>
            </div>
        </div>

        <div class="text-center text-gray-500 text-sm mt-10">
            © 2026 SânBóngPro. All rights reserved.
        </div>
    </footer>

</body>

</html>
