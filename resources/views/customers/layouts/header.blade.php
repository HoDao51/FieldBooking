<div class="max-w-7xl mx-auto px-6 py-2 flex items-center justify-between">
    <a href="{{ route('san.index') }}">
        <div class="flex items-center">
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

            <div class="leading-tight">
                <div class="text-[20px] font-semibold text-green-600 leading-5">
                    S&acirc;nB&oacute;ng<span class="text-gray-800 font-bold">Pro</span>
                </div>
            </div>
        </div>
    </a>

    <form method="GET" action="{{ route('home.search') }}" class="hidden md:flex w-1/3">
        <div class="relative w-[400px] rounded-lg border border-gray-300 ">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <path fill="currentColor" fill-rule="evenodd"
                    d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                    clip-rule="evenodd" />
            </svg>
            <input type="text" name="search" value="" placeholder="T&igrave;m ki&#7871;m s&acirc;n theo t&ecirc;n, &#273;&#7883;a ch&#7881;,..."
                class="pl-10 pr-3 py-2 rounded-lg w-full d-lg focus:ring-1 focus:ring-green-400 outline-none">
        </div>
    </form>

    @if (session('success'))
        <div id="toast-success"
            class="fixed top-6 left-1/2 -translate-x-1/2 
                bg-white shadow-lg rounded-xl px-6 py-3 
                flex items-center gap-3 border border-green-200 
                animate-fadeIn z-50">

            <div class="bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m-2 15l-5-5l1.41-1.41L10 14.17l7.59-7.59L19 8z" />
                </svg>
            </div>

            <span class="text-gray-800 font-medium">
                {{ session('success') }}
            </span>
        </div>
    @endif

    @guest
        <div class="flex items-center gap-4">
            <a href="{{ route('customer.login') }}" class="text-gray-600 hover:text-green-600">
                &#272;&#259;ng nh&#7853;p
            </a>

            <a href="{{ route('customer.register') }}"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                &#272;&#259;ng k&yacute;
            </a>
        </div>
    @endguest

    @auth
        <div class="relative inline-block text-left">
            <button id="profileBtn" class="flex items-center gap-3 px-3 py-2 rounded-lg transition" aria-haspopup="true"
                aria-expanded="false">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-green-600 font-semibold">
                    @if (auth()->user()->customers->avatar == null)
                        <img src="{{ asset('images/sbcf-default-avatar.png') }}"
                            class="w-full h-full object-cover rounded-full border-2 border-gray-300">
                    @else
                        <img src="{{ asset('storage/' . auth()->user()->customers->avatar) }}"
                            class="w-full h-full object-cover rounded-full border-2 border-gray-300">
                    @endif
                </div>

                <div class="text-left leading-tight">
                    <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 ml-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="profileDropdown"
                class="hidden absolute right-0 mt-2 w-60 bg-white shadow-lg border border-gray-200 rounded-lg p-2 z-50">

                <a href="{{ route('information.index') }}"
                    class="flex items-center gap-2 font-semibold block px-4 py-2 text-green-600 hover:bg-green-100 rounded-md mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Th&ocirc;ng tin c&aacute; nh&acirc;n
                </a>

                <a href="{{ route('information.history', auth()->user()->id) }}"
                    class="flex items-center gap-2 font-semibold block px-4 py-2 text-green-600 hover:bg-green-100 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="0">
                        <path fill="currentColor"
                            d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                    </svg>
                    L&#7883;ch s&#7917; &#273;&#7863;t s&acirc;n
                </a>

                <hr class="my-2">

                <a href="{{ route('customer.logout') }}"
                    class="flex items-center gap-2 font-semibold block px-4 py-2 text-red-600 hover:bg-red-600 hover:text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 32 32">
                        <path fill="currentColor" stroke="none"
                            d="M26 4h2v24h-2zM11.414 20.586L7.828 17H22v-2H7.828l3.586-3.586L10 10l-6 6l6 6z" />
                    </svg>
                    &#272;&#259;ng xu&#7845;t
                </a>
            </div>
        </div>
    @endauth
</div>