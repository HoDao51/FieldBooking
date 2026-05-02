@extends('customers.layouts.app')

@section('content')
    <div class="flex items-start max-w-6xl mx-auto mt-5 mb-10 gap-6">
        <div class="w-64 bg-white rounded-xl shadow p-6 text-center flex flex-col">
            <div
                class="w-24 h-24 bg-green-500 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto">
                @if (auth()->user()->customers->avatar == null)
                    <img src="{{ asset('images/sbcf-default-avatar.png') }}"
                        class="w-full h-full object-cover rounded-full border-2 border-gray-300">
                @else
                    <img src="{{ asset('storage/' . auth()->user()->customers->avatar) }}"
                        class="w-full h-full object-cover rounded-full border-2 border-gray-300">
                @endif
            </div>

            <p class="mt-3 text-base text-gray-500">
                {{ auth()->user()->email }}
            </p>

            <div class="mt-8 space-y-2 text-left">
                <a href="{{ route('information.index') }}"
                    class="flex items-center space-x-2 block px-3 py-2 rounded hover:text-green-600 font-semibold
                    {{ request()->routeIs('information.index') ? 'bg-green-100 text-green-600 font-semibold' : 'hover:bg-green-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M19.618 21.25c0-3.602-4.016-6.53-7.618-6.53s-7.618 2.928-7.618 6.53M12 11.456a4.353 4.353 0 1 0 0-8.706a4.353 4.353 0 0 0 0 8.706" />
                    </svg>
                    <span>Thông tin cá nhân</span>
                </a>

                <a href="{{ route('information.history') }}"
                    class="flex items-center space-x-2 block px-3 py-2 rounded hover:text-green-600 font-semibold
                    {{ request()->routeIs('information.history') ? 'bg-green-100 text-green-600 font-semibold' : 'hover:bg-green-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 24 24">
                        <path fill="currentColor" stroke="none"
                            d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                    </svg>
                    <span>Lịch sử đặt sân</span>
                </a>

                <a href="{{ route('information.transactionHistory') }}"
                    class="flex items-center space-x-2 block px-3 py-2 rounded hover:text-green-600 font-semibold
                    {{ request()->routeIs('information.transactionHistory') ? 'bg-green-100 text-green-600 font-semibold' : 'hover:bg-green-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v5l3 2" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M22 12a10 10 0 1 1-3.2-7.3" />
                    </svg>
                    <span>Lịch sử giao dịch</span>
                </a>

                <a href="{{ route('customer.logout') }}"
                    class="flex items-center space-x-2 block px-3 py-2 rounded text-red-600 font-semibold hover:bg-red-600 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 32 32">
                        <path fill="currentColor" stroke="none"
                            d="M26 4h2v24h-2zM11.414 20.586L7.828 17H22v-2H7.828l3.586-3.586L10 10l-6 6l6 6z" />
                    </svg>
                    <span>Đăng xuất</span>
                </a>
            </div>
        </div>

        <div class="flex-1 bg-white rounded-xl shadow p-8">
            <h2 class="text-2xl font-bold mb-6">
                Thông tin cá nhân
            </h2>

            <form method="POST" action="{{ route('information.postProfile') }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Họ và tên
                        </label>

                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                            placeholder="Nhập họ và tên"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Email
                        </label>

                        <input type="email" value="{{ auth()->user()->email }}" disabled
                            class="w-full border border-gray-200 bg-gray-100 rounded-lg px-3 py-2 cursor-not-allowed">
                    </div>

                    <div class="md:col-span-2">
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Số điện thoại
                        </label>

                        <input type="text" name="phoneNumber"
                            value="{{ auth()->user()->customers->phoneNumber }}"
                            placeholder="Nhập số điện thoại"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">

                        @error('phoneNumber')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Ảnh đại diện
                        </label>

                        <input type="file" name="avatar" id="avatar" accept="image/*"
                            class="w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 text-gray-700 focus:outline-none focus:ring-1 focus:ring-green-400">

                        @error('avatar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                        Cập nhật thông tin
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
