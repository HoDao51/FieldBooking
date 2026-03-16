@extends('customers.layouts.app')

@section('content')
    <div class="flex items-start max-w-6xl mx-auto mt-10 mb-10 gap-6 ">
        <!-- Sidebar -->
        <div class="w-64 bg-white rounded-xl shadow p-6 text-center flex flex-col">
            <div
                class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto">
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

            <!-- Menu -->
            <div class="mt-8 space-y-2 text-left">
                <a href="#" class="block px-3 py-2 rounded hover:text-green-800 font-semibold">
                    Thông tin cá nhân
                </a>

                <a href="#" class="block px-3 py-2 rounded hover:text-green-800 font-semibold">
                    Lịch sử đặt sân
                </a>

                <a href="#" class="block px-3 py-2 rounded hover:text-green-800 font-semibold">
                    Đăng xuất
                </a>
            </div>
        </div>


        <!-- Main Content -->
        <div class="flex-1 bg-white rounded-xl shadow p-8">

            <h2 class="text-2xl font-bold mb-6">
                Thông tin cá nhân
            </h2>

            <form method="POST" action="{{ route('information.postProfile') }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Họ tên -->
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

                    <!-- Email -->
                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Email
                        </label>

                        <input type="email" value="{{ auth()->user()->email }}" disabled
                            class="w-full border border-gray-200 bg-gray-100 rounded-lg px-3 py-2 cursor-not-allowed">

                    </div>

                    <!-- Số điện thoại -->
                    <div class="md:col-span-2">
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Số điện thoại
                        </label>

                        <input type="text" name="phoneNumber"
                            value="{{ old('phoneNumber', auth()->user()->customers->phoneNumber ?? '') }}"
                            placeholder="Nhập số điện thoại"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">

                        @error('phoneNumber')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Avatar -->
                    <div class="md:col-span-2">
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Ảnh đại diện
                        </label>
                        <div class="flex items-center gap-4">
                            <!-- Upload -->
                            <input type="file" name="avatar" id="avatar" accept="image/*"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                        </div>

                        @error('avatar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Button -->
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
