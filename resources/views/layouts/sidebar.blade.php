<body>
  <aside class="w-50 bg-white border border-gray-200 text-black p-4 h-full">
    <nav class="flex flex-col space-y-2">

        <!-- Trang tổng quan -->
        <a href=""
        class="flex items-center space-x-2  px-3 py-2 rounded-md hover:text-green-800
        {{ request()->routeIs() ? 'bg-green-200 font-semibold' : ' hover:bg-green-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 22 22" stroke="currentColor" stroke-width="0">
              <path fill="currentColor" d="m16 8.41l-4.5-4.5L4.41 11H6v8h3v-6h5v6h3v-8h1.59L17 9.41V6h-1zM2 12l9.5-9.5L15 6V5h3v4l3 3h-3v8h-5v-6h-3v6H5v-8z"/>
          </svg>
          <span>Thống kê</span>
        </a>
      

      
        <!-- Quản lý nhân viên -->
      <a href=""
      class="flex items-center space-x-2  px-3 py-2 rounded-md hover:text-green-800
      {{ request()->routeIs('nhanVien.*') ? 'bg-green-200 font-semibold' : ' hover:bg-green-200' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 36 36" stroke="currentColor" stroke-width="0">
            <path fill="currentColor" d="M18.42 16.31a5.7 5.7 0 1 1 5.76-5.7a5.74 5.74 0 0 1-5.76 5.7m0-9.4a3.7 3.7 0 1 0 3.76 3.7a3.74 3.74 0 0 0-3.76-3.7"/><path fill="currentColor" d="M18.42 16.31a5.7 5.7 0 1 1 5.76-5.7a5.74 5.74 0 0 1-5.76 5.7m0-9.4a3.7 3.7 0 1 0 3.76 3.7a3.74 3.74 0 0 0-3.76-3.7m3.49 10.74a20.6 20.6 0 0 0-13 2a1.77 1.77 0 0 0-.91 1.6v3.56a1 1 0 0 0 2 0v-3.43a18.92 18.92 0 0 1 12-1.68Z"/><path fill="currentColor" d="M33 22h-6.7v-1.48a1 1 0 0 0-2 0V22H17a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V23a1 1 0 0 0-1-1m-1 10H18v-8h6.3v.41a1 1 0 0 0 2 0V24H32Z"/><path fill="currentColor" d="M21.81 27.42h5.96v1.4h-5.96zM10.84 12.24a18 18 0 0 0-7.95 2A1.67 1.67 0 0 0 2 15.71v3.1a1 1 0 0 0 2 0v-2.9a16 16 0 0 1 7.58-1.67a7.3 7.3 0 0 1-.74-2m22.27 1.99a17.8 17.8 0 0 0-7.12-2a7.5 7.5 0 0 1-.73 2A15.9 15.9 0 0 1 32 15.91v2.9a1 1 0 1 0 2 0v-3.1a1.67 1.67 0 0 0-.89-1.48m-22.45-3.62v-.67a3.07 3.07 0 0 1 .54-6.11a3.15 3.15 0 0 1 2.2.89a8.2 8.2 0 0 1 1.7-1.08a5.13 5.13 0 0 0-9 3.27a5.1 5.1 0 0 0 4.7 5a7.4 7.4 0 0 1-.14-1.3m14.11-8.78a5.17 5.17 0 0 0-3.69 1.55a8 8 0 0 1 1.9 1a3.14 3.14 0 0 1 4.93 2.52a3.09 3.09 0 0 1-1.79 2.77a7 7 0 0 1 .06.93a8 8 0 0 1-.1 1.2a5.1 5.1 0 0 0 3.83-4.9a5.12 5.12 0 0 0-5.14-5.07"/>
        </svg>
        <span>Quản lý khách hàng</span>
      </a>
      
      
      
        <!-- Quản lý sinh viên -->
        <a href=""
        class="flex items-center space-x-2  px-3 py-2 rounded-md hover:text-green-800
        {{ request()->routeIs('sinhVien.*') ? 'bg-green-200 font-semibold' : ' hover:bg-green-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0">
              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3">
                  <path d="M2.5 6L8 4l5.5 2L11 7.5V9s-.667-.5-3-.5S5 9 5 9V7.5zm0 0v4"/>
                  <path d="M11 8.5v.889c0 1.718-1.343 3.111-3 3.111s-3-1.393-3-3.111V8.5m10.318 2.53s.485-.353 2.182-.353s2.182.352 2.182.352m-4.364 0V10L13.5 9l4-1.5l4 1.5l-1.818 1v1.03m-4.364 0v.288a2.182 2.182 0 1 0 4.364 0v-.289M4.385 15.926c-.943.527-3.416 1.602-1.91 2.947C3.211 19.53 4.03 20 5.061 20h5.878c1.03 0 1.85-.47 2.586-1.127c1.506-1.345-.967-2.42-1.91-2.947c-2.212-1.235-5.018-1.235-7.23 0M16 20h3.705c.773 0 1.387-.376 1.939-.902c1.13-1.076-.725-1.936-1.432-2.357A5.34 5.34 0 0 0 16 16.214"/>
              </g>
          </svg>
          <span>Quản lý nhân viên</span>
        </a>
      

      <!-- thông tin cá nhân -->
      
        <!-- Quản lý học kỳ -->
        <a href=""
        class="flex items-center space-x-2  px-3 py-2 rounded-md hover:text-green-800
        {{ request()->routeIs('thongTinCaNhan.*') ? 'bg-green-200 font-semibold' : ' hover:bg-green-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 36 36" stroke="currentColor" stroke-width="0">
            <path fill="currentColor" d="M18 17a7 7 0 1 0-7-7a7 7 0 0 0 7 7m0-12a5 5 0 1 1-5 5a5 5 0 0 1 5-5" class="clr-i-outline clr-i-outline-path-1"/><path fill="currentColor" d="M30.47 24.37a17.16 17.16 0 0 0-24.93 0A2 2 0 0 0 5 25.74V31a2 2 0 0 0 2 2h22a2 2 0 0 0 2-2v-5.26a2 2 0 0 0-.53-1.37M29 31H7v-5.27a15.17 15.17 0 0 1 22 0Z" class="clr-i-outline clr-i-outline-path-2"/>
            <path fill="none" d="M0 0h36v36H0z"/>
          </svg>
          <span>Quản lý loại sân</span>
        </a>
      

      
        <!-- Quản lý khoa -->
        <a href=""
        class="flex items-center space-x-2  px-3 py-2 rounded-md hover:text-green-800
        {{ request()->routeIs('khoa.*') ? 'bg-green-200 font-semibold' : ' hover:bg-green-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="3 6 21 13" stroke="currentColor" stroke-width="0">
              <path fill="currentColor" d="M7 3h9a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3m0 1a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-3v6.7l-3-2.1l-3 2.1zm5 0H8v4.78l2-1.4l2 1.4z"/>
          </svg>
          <span>Quản lý sân bóng</span>
        </a>
      

      
        <!-- Quản lý lớp -->
        <a href=""
        class="flex items-center space-x-2  px-3 py-2 rounded-md hover:text-green-800
        {{ request()->routeIs('lop.*') ? 'bg-green-200 font-semibold' : ' hover:bg-green-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="3 0 36 36" stroke="currentColor" stroke-width="0">
              <path fill="currentColor" d="M17.9 17.3c2.7 0 4.8-2.2 4.8-4.9s-2.2-4.8-4.9-4.8S13 9.8 13 12.4c0 2.7 2.2 4.9 4.9 4.9m-.1-7.7q.15 0 0 0c1.6 0 2.9 1.3 2.9 2.9s-1.3 2.8-2.9 2.8S15 14 15 12.5c0-1.6 1.3-2.9 2.8-2.9" class="clr-i-outline clr-i-outline-path-1"/><path fill="currentColor" d="M32.7 16.7c-1.9-1.7-4.4-2.6-7-2.5h-.8q-.3 1.2-.9 2.1c.6-.1 1.1-.1 1.7-.1c1.9-.1 3.8.5 5.3 1.6V25h2v-8z" class="clr-i-outline clr-i-outline-path-2"/>
              <path fill="currentColor" d="M23.4 7.8c.5-1.2 1.9-1.8 3.2-1.3c1.2.5 1.8 1.9 1.3 3.2c-.4.9-1.3 1.5-2.2 1.5c-.2 0-.5 0-.7-.1c.1.5.1 1 .1 1.4v.6c.2 0 .4.1.6.1c2.5 0 4.5-2 4.5-4.4c0-2.5-2-4.5-4.4-4.5c-1.6 0-3 .8-3.8 2.2c.5.3 1 .7 1.4 1.3" class="clr-i-outline clr-i-outline-path-3"/><path fill="currentColor" d="M12 16.4q-.6-.9-.9-2.1h-.8c-2.6-.1-5.1.8-7 2.4L3 17v8h2v-7.2c1.6-1.1 3.4-1.7 5.3-1.6c.6 0 1.2.1 1.7.2" class="clr-i-outline clr-i-outline-path-4"/><path fill="currentColor" d="M10.3 13.1c.2 0 .4 0 .6-.1v-.6c0-.5 0-1 .1-1.4c-.2.1-.5.1-.7.1c-1.3 0-2.4-1.1-2.4-2.4S9 6.3 10.3 6.3c1 0 1.9.6 2.3 1.5c.4-.5 1-1 1.5-1.4c-1.3-2.1-4-2.8-6.1-1.5s-2.8 4-1.5 6.1c.8 1.3 2.2 2.1 3.8 2.1" class="clr-i-outline clr-i-outline-path-5"/><path fill="currentColor" d="m26.1 22.7l-.2-.3c-2-2.2-4.8-3.5-7.8-3.4c-3-.1-5.9 1.2-7.9 3.4l-.2.3v7.6c0 .9.7 1.7 1.7 1.7h12.8c.9 0 1.7-.8 1.7-1.7v-7.6zm-2 7.3H12v-6.6c1.6-1.6 3.8-2.4 6.1-2.4c2.2-.1 4.4.8 6 2.4z" class="clr-i-outline clr-i-outline-path-6"/>
              <path fill="none" d="M0 0h36v36H0z"/>
          </svg>
          <span>Quản lý khung giờ</span>
        </a>
      

      
        <!-- Quản lý năm học -->
        <a href=""
        class="flex items-center space-x-2  px-3 py-2 rounded-md hover:text-green-800
        {{ request()->routeIs('namHoc.*') ? 'bg-green-200 font-semibold' : 'hover:bg-green-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="#222C3A" viewBox="0 0 2048 2048" stroke="currentColor" stroke-width="0">
              <path fill="currentColor" d="M1664 512h256v1536H256V512h256V384h128v128h896V384h128zm128 128h-128v128h128zm-256 0H640v128h896zm-1024 0H384v128h128zM384 1920h1408V896H384zM256 384V256H128v1408H0V128h256V0h128v128h896V0h128v128h256v128h-256v128h-128V256H384v128zm384 1024v-128h128v128zm256 0v-128h128v128zm256 0v-128h128v128zm256 0v-128h128v128zm-768 256v-128h128v128zm256 0v-128h128v128zm256 0v-128h128v128zm-256-512v-128h128v128zm256 0v-128h128v128zm256 0v-128h128v128z"/>
          </svg>
          <span>Quản lý đặt sân</span>
        </a>
      

      <!-- Quản lý học phí -->
      
        <a href=""
        class="flex items-center space-x-2  px-3 py-2 rounded-md hover:text-green-800
        {{ request()->routeIs('hocPhi.*') ? 'bg-green-200 font-semibold' : 'hover:bg-green-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0">
              <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1">
                  <path stroke-linecap="round" d="m5.5 11l-.5-.5L7 7L4.5 8L2 7l2 3.5l-3.5 5v3l2.5 2h.5m-1-10H6m11.5.5l.5-.5L16 7l2.5 1L21 7l-2 3.5l3.5 5v3l-2.5 2h-.5m1-10H17m-4.5 4h-2l-.5 1l.5 1h2l.5 1l-.5 1h-2m1-4v-1m0 6v-1"/>
                  <path d="m11.5 4l2 1.5L16 4l-2.5 5.5l4 5v5l-4 2h-4l-4-2v-5l4-5L7 4l2.5 1.5z"/>
                  <path stroke-linecap="round" d="M15.5 9.5h-8"/>
              </g>
          </svg>
          <span>Phương thức thanh toán</span>
        </a>
      
        <a href=""
        class="flex items-center space-x-2  px-3 py-2 rounded-md hover:text-green-800
        {{ request()->routeIs('thongTinHocPhi.index') ? 'bg-green-200 font-semibold' : 'hover:bg-green-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0">
              <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1">
                  <path stroke-linecap="round" d="m5.5 11l-.5-.5L7 7L4.5 8L2 7l2 3.5l-3.5 5v3l2.5 2h.5m-1-10H6m11.5.5l.5-.5L16 7l2.5 1L21 7l-2 3.5l3.5 5v3l-2.5 2h-.5m1-10H17m-4.5 4h-2l-.5 1l.5 1h2l.5 1l-.5 1h-2m1-4v-1m0 6v-1"/>
                  <path d="m11.5 4l2 1.5L16 4l-2.5 5.5l4 5v5l-4 2h-4l-4-2v-5l4-5L7 4l2.5 1.5z"/>
                  <path stroke-linecap="round" d="M15.5 9.5h-8"/>
              </g>
          </svg>
          <span>Lịch sử đặt sân</span>
        </a>
      
    </nav>
  </aside>
</body>