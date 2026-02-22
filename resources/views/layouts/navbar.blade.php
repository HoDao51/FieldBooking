<header class="flex items-center justify-between border-b border-[E5E6E6] px-6 py-3 bg-white">
    <!-- Logo + tên -->
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
                <div class="text-[11px] text-gray-500 leading-3">
                    Trang quản trị
                </div>
            </div>
        </div>
    </a>


    <div class="relative inline-block text-left">

        <!-- Profile button -->
        <button id="profileBtn" class="flex items-center gap-3 px-3 py-2 rounded-lg transition" aria-haspopup="true"
            aria-expanded="false">

            <!-- Avatar tròn -->
            <div class="w-10 h-10 rounded-full flex items-center justify-center text-green-600 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                    <path fill="currentColor"
                        d="M248 8C111 8 0 119 0 256s111 248 248 248s248-111 248-248S385 8 248 8m0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88s-88-39.4-88-88s39.4-88 88-88m0 344c-58.7 0-111.3-26.6-146.5-68.2c18.8-35.4 55.6-59.8 98.5-59.8c2.4 0 4.8.4 7.1 1.1c13 4.2 26.6 6.9 40.9 6.9s28-2.7 40.9-6.9c2.3-.7 4.7-1.1 7.1-1.1c42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448" />
                </svg>
            </div>

            <!-- Name + Role -->
            <div class="text-left leading-tight">
                <p class="font-semibold text-gray-800">Trần Đức Hiếu</p>
                <p class="text-sm text-gray-500">Quản trị viên</p>
            </div>

            <!-- Icon mũi tên -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 ml-1" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>

        </button>

        <!-- Dropdown -->
        <div id="profileDropdown"
            class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg border border-gray-200 rounded-lg p-2 z-50">

            <a href="" class="font-semibold block px-4 py-2 text-green-600 hover:bg-green-100 rounded-md">
                Thông tin cá nhân
            </a>

            <hr class="my-2">

            <a href=""
                class="font-semibold block px-4 py-2 text-gray-600 hover:bg-red-600 hover:text-white rounded-md">
                Đăng xuất
            </a>
        </div>

    </div>
</header>
<!-- script menu lựa chọn -->
@vite('resources/js/profile_dropdown.js')
