
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="{{route('san.index')}}">
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