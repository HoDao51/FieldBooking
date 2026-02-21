<header class="flex items-center justify-between border-b border-[E5E6E6] px-6 py-3 bg-white">
    <!-- Logo + tên -->
    <a href=""
    >
        <div class="flex items-center">
            <!-- Icon -->
            <div class="text-green-600 pr-2 ">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-10 h-10"
                    fill="none" 
                    viewBox="0 0 24 24"
                    stroke="currentColor" 
                    stroke-width="1.5">
                    <g stroke-linecap="round" stroke-linejoin="round">
                        <path d="M.75 3.75h22.5v16.5H.75zm11.25 0v16.5"/>
                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0-6 0"/>
                        <path d="M.75 8.25h3a1.5 1.5 0 0 1 1.5 1.5v4.5a1.5 1.5 0 0 1-1.5 1.5h-3"/>
                        <path d="M22.5 8.25h-3a1.5 1.5 0 0 0-1.5 1.5v4.5a1.5 1.5 0 0 0 1.5 1.5h3"/>
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
    <div class="flex items-center gap-4 grow flex items-center lg:ml-[75px]">
        <span class="hidden lg:block mx-1 lg:text-2xl xl:text-3xl font-semibold text-gray-600 hover:text-blue-950">
          Tổng quan hệ thống
        </span>

    </div>

   
    <div class="relative inline-block text-left ">
      <!-- Profile button -->
      <button id="profileBtn" class="flex items-center space-x-2" aria-haspopup="true" aria-expanded="false">
        <div>
          <p class="font-semibold text-lg text-gray-700 leading-tight">tdh</p>
          <p class="text-gray-600 text-sm">     
              Quản trị viên
          </p>
        </div>
      
        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-300">
            <img src="" alt="Avatar" class="w-full h-full object-cover">
        </div>
      </button>
      <!-- Dropdown -->
      <div id="profileDropdown" 
          class="hidden absolute bg-white shadow-lg select-none border border-base-200 rounded-lg w-auto min-w-max font-semibold right-0 top-12 p-2"
          role="menu" aria-orientation="vertical" aria-labelledby="profileBtn"
          >
       
          <a href="" class="block px-6 py-2 text-blue-600 hover:bg-gray-100 rounded-lg mb-2" role="menuitem">
            Thông tin cá nhân
          </a>
        
        <hr class="border-gray-200 my-0 mx-2">
        <a href="" class="block px-6 py-2 text-gray-600 hover:bg-gray-100 rounded-lg mt-2" role="menuitem">
          Đăng xuất
        </a>
      </div>
    </div>
</header>
<!-- script menu lựa chọn -->
@vite('resources/js/profile_dropdown.js')