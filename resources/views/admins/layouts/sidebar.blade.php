<body>
    <aside class="bg-white border-r border-gray-200 text-black p-4 h-full">
        <nav class="flex flex-col space-y-2">

            <!-- Trang tổng quan -->
            <a href="{{route('admins.index')}}"
                class="flex items-center space-x-2  px-3 py-2 rounded hover:text-green-800 font-semibold
        {{ request()->routeIs('admins.index') ? 'bg-green-200 text-green-800 font-semibold' : ' hover:bg-green-200' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 opacity-60" fill="#222C3A" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="0">
                    <path fill="currentColor"
                        d="M6 15H2c-.6 0-1 .4-1 1v6c0 .6.4 1 1 1h4c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1m8-6h-4c-.6 0-1 .4-1 1v12c0 .6.4 1 1 1h4c.6 0 1-.4 1-1V10c0-.6-.4-1-1-1m8-8h-4c-.6 0-1 .4-1 1v20c0 .6.4 1 1 1h4c.6 0 1-.4 1-1V2c0-.6-.4-1-1-1" />
                </svg>
                <span>Thống kê</span>
            </a>

            <!-- Quản lý nhân viên -->
            <a href="{{ route('nhanVien.index') }}"
                class="flex items-center space-x-2  px-3 py-2 rounded hover:text-green-800 font-semibold
      {{ request()->routeIs('nhanVien.*') ? 'bg-green-200 text-green-800 font-semibold' : ' hover:bg-green-200' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 36 36"
                    stroke="currentColor" stroke-width="0">
                    <path fill="currentColor"
                        d="M18.42 16.31a5.7 5.7 0 1 1 5.76-5.7a5.74 5.74 0 0 1-5.76 5.7m0-9.4a3.7 3.7 0 1 0 3.76 3.7a3.74 3.74 0 0 0-3.76-3.7" />
                    <path fill="currentColor"
                        d="M18.42 16.31a5.7 5.7 0 1 1 5.76-5.7a5.74 5.74 0 0 1-5.76 5.7m0-9.4a3.7 3.7 0 1 0 3.76 3.7a3.74 3.74 0 0 0-3.76-3.7m3.49 10.74a20.6 20.6 0 0 0-13 2a1.77 1.77 0 0 0-.91 1.6v3.56a1 1 0 0 0 2 0v-3.43a18.92 18.92 0 0 1 12-1.68Z" />
                    <path fill="currentColor"
                        d="M33 22h-6.7v-1.48a1 1 0 0 0-2 0V22H17a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V23a1 1 0 0 0-1-1m-1 10H18v-8h6.3v.41a1 1 0 0 0 2 0V24H32Z" />
                    <path fill="currentColor"
                        d="M21.81 27.42h5.96v1.4h-5.96zM10.84 12.24a18 18 0 0 0-7.95 2A1.67 1.67 0 0 0 2 15.71v3.1a1 1 0 0 0 2 0v-2.9a16 16 0 0 1 7.58-1.67a7.3 7.3 0 0 1-.74-2m22.27 1.99a17.8 17.8 0 0 0-7.12-2a7.5 7.5 0 0 1-.73 2A15.9 15.9 0 0 1 32 15.91v2.9a1 1 0 1 0 2 0v-3.1a1.67 1.67 0 0 0-.89-1.48m-22.45-3.62v-.67a3.07 3.07 0 0 1 .54-6.11a3.15 3.15 0 0 1 2.2.89a8.2 8.2 0 0 1 1.7-1.08a5.13 5.13 0 0 0-9 3.27a5.1 5.1 0 0 0 4.7 5a7.4 7.4 0 0 1-.14-1.3m14.11-8.78a5.17 5.17 0 0 0-3.69 1.55a8 8 0 0 1 1.9 1a3.14 3.14 0 0 1 4.93 2.52a3.09 3.09 0 0 1-1.79 2.77a7 7 0 0 1 .06.93a8 8 0 0 1-.1 1.2a5.1 5.1 0 0 0 3.83-4.9a5.12 5.12 0 0 0-5.14-5.07" />
                </svg>
                <span>Quản lý nhân viên</span>
            </a>

            <!-- Quản lý khách hàng -->
            <a href=""
                class="flex items-center space-x-2  px-3 py-2 rounded hover:text-green-800 font-semibold
        {{ request()->routeIs('sinhVien.*') ? 'bg-green-200 text-green-800 font-semibold' : ' hover:bg-green-200' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="0">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5">
                        <path
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M16 3.128a4 4 0 0 1 0 7.744M22 21v-2a4 4 0 0 0-3-3.87" />
                        <circle cx="9" cy="7" r="4" />
                    </g>
                </svg>
                <span>Quản lý khách hàng</span>
            </a>

            <!-- Quản lý sân bóng -->
            <a href=""
                class="flex items-center space-x-2  px-3 py-2 rounded hover:text-green-800 font-semibold
        {{ request()->routeIs('thongTinCaNhan.*') ? 'bg-green-200 text-green-800 font-semibold' : ' hover:bg-green-200' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 256 256"
                    stroke="currentColor" stroke-width="3">
                    <path fill="currentColor"
                        d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                </svg>
                <span>Quản lý sân bóng</span>
            </a>

            <!-- Cấu hình giá giờ -->
            <a href=""
                class="flex items-center space-x-2 px-3 py-2 rounded hover:text-green-800 font-semibold
        {{ request()->routeIs('lop.*') ? 'bg-green-200 text-green-800 font-semibold' : 'hover:bg-green-200' }}">
                <span class="w-6 h-6 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 scale-125 opacity-80" viewBox="0 0 56 56"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M29 30v10c3.519-.316 5-2.287 5-4.89c0-2.507-1.152-3.99-5-5.11m-3-5v-9c-3.273.415-5 2.33-5 4.43s1.364 3.647 5 4.57m2.84.737l1.072.277C35.784 27.423 39 29.917 39 34.836c0 5.658-4.466 8.868-10.16 9.284V48h-2.523v-3.88c-5.672-.439-10.16-3.741-10.317-9.284h4.622c.402 2.702 2.1 4.688 5.695 5.08V29.849l-.916-.231c-5.672-1.363-8.731-3.996-8.731-8.684c0-5.173 4.02-8.591 9.647-9.03V8h2.523v3.903c5.582.462 9.624 3.926 9.803 9.169h-4.645c-.29-2.91-2.3-4.596-5.158-4.966z" />
                    </svg>
                </span>

                <span>Cấu hình giá giờ</span>
            </a>

            <!-- Quản lý đơn đặt -->
            <a href=""
                class="flex items-center space-x-2  px-3 py-2 rounded hover:text-green-800 font-semibold
        {{ request()->routeIs('namHoc.*') ? 'bg-green-200 text-green-800 font-semibold' : 'hover:bg-green-200' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 16 16"
                    stroke="currentColor" stroke-width="0">
                    <path fill="none" stroke="currentColor" stroke-linejoin="round"
                        d="M5 11.5h4M5 9h6M5 6.5h6m-5.5-4h-2v12h9v-12h-2m-5-1h5l-.625 2h-3.75z" stroke-width="1" />
                </svg>
                <span>Quản lý đơn đặt</span>
            </a>

            <!-- Phương thức thanh toán -->
            <a href=""
                class="flex items-center space-x-2  px-3 py-2 rounded hover:text-green-800 font-semibold
        {{ request()->routeIs('hocPhi.*') ? 'bg-green-200 text-green-800 font-semibold' : 'hover:bg-green-200' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="0">
                    <path fill="currentColor"
                        d="m21.41 11.58l-9-9A2 2 0 0 0 11 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 .59 1.42l9 9A2 2 0 0 0 13 22a2 2 0 0 0 1.41-.59l7-7A2 2 0 0 0 22 13a2 2 0 0 0-.59-1.42M13 20l-9-9V4h7l9 9M6.5 5A1.5 1.5 0 1 1 5 6.5A1.5 1.5 0 0 1 6.5 5" />
                </svg>
                <span>Phương thức thanh toán</span>
            </a>

            <!-- Lịch sử đặt sân -->
            <a href=""
                class="flex items-center space-x-2  px-3 py-2 rounded hover:text-green-800 font-semibold
        {{ request()->routeIs('thongTinHocPhi.index') ? 'bg-green-200 text-green-800 font-semibold' : 'hover:bg-green-200' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 scale-110" fill="#222C3A" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="0">
                    <path fill="currentColor"
                        d="M12 21q-3.45 0-6.012-2.287T3.05 13H5.1q.35 2.6 2.313 4.3T12 19q2.925 0 4.963-2.037T19 12t-2.037-4.962T12 5q-1.725 0-3.225.8T6.25 8H9v2H3V4h2v2.35q1.275-1.6 3.113-2.475T12 3q1.875 0 3.513.713t2.85 1.924t1.925 2.85T21 12t-.712 3.513t-1.925 2.85t-2.85 1.925T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z" />
                </svg>
                <span>Lịch sử đặt sân</span>
            </a>

            <!-- Đăng xuất -->
            <a href="{{route('logout')}}"
                class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-red-600 hover:text-white transition font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 32 32" fill="currentColor">
                    <path d="M26 4h2v24h-2zM11.414 20.586L7.828 17H22v-2H7.828l3.586-3.586L10 10l-6 6l6 6z" />
                </svg>
                <span>Đăng xuất</span>
            </a>

        </nav>
    </aside>
</body>
