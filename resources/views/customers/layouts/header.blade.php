        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('san.index') }}">
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

            <!-- Search -->
            <form method="GET" action="#" class="hidden md:flex w-1/3">
                <!-- Thanh tìm kiếm -->
                <div class="relative w-[400px] rounded-lg border border-gray-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" value="" placeholder="Tìm kiếm sân theo tên, địa chỉ,..."
                        class="pl-10 pr-3 py-2 rounded-lg w-full d-lg focus:ring-2 focus:ring-green-400 outline-none">
                </div>
            </form>

            <div class="flex items-center gap-4">
                <a href="{{route('customer.login')}}" class="text-gray-600 hover:text-green-600">Đăng nhập</a>
                <a href="#" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    Đăng ký
                </a>
            </div>
        </div>
