@extends('admins.layouts.app')

@section('content')
    <div class="flex items-start max-w-6xl mx-auto mt-5 gap-6">

        <!-- Sidebar -->
        <div class="w-64 bg-white rounded-xl shadow p-6 text-center flex flex-col">

            <div class="w-24 h-24 mx-auto">
                @if (auth()->user()->employees->avatar == null)
                    <img src="{{ asset('images/sbcf-default-avatar.png') }}"
                        class="w-full h-full object-cover rounded-full border-2 border-gray-300">
                @else
                    <img src="{{ asset('storage/' . auth()->user()->employees->avatar) }}"
                        class="w-full h-full object-cover rounded-full border-2 border-gray-300">
                @endif
            </div>

            <p class="mt-3 text-base text-gray-700 font-medium">
                {{ auth()->user()->name }}
            </p>
            <p class="mt-3 text-base text-gray-500">
                {{ auth()->user()->email }}
            </p>

            <p class="text-base text-gray-500">
                {{ auth()->user()->employees->phoneNumber }}
            </p>

        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-white rounded-xl shadow p-8">
            <h2 class="text-2xl text-[#1f2937] font-bold mb-6">
                Thông tin cá nhân
            </h2>
            <form method="POST" action="{{ route('nhanVien.update', auth()->user()->employees->id) }}"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Họ tên -->
                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Họ và tên
                        </label>

                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                            placeholder="Nhập họ và tên"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                        @error('name', 'edit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" disabled
                            class="w-full border border-gray-300 bg-gray-100 rounded-lg px-3 py-2 cursor-not-allowed">
                    </div>

                    <!-- Số điện thoại -->
                    <div class="md:col-span-2">
                        <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                            Số điện thoại
                        </label>

                        <input type="text" name="phoneNumber" placeholder="Nhập số điện thoại"
                            value="{{ old('phoneNumber', auth()->user()->employees->phoneNumber) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                        @error('phoneNumber', 'edit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tình trạng -->
                    <div class="md:col-span-2">
                        <label class="pt-0 label label-text font-semibold text-[#1f2937] block">
                            Tình trạng
                        </label>

                        @if (auth()->user()->employees->status == 0)
                            <p class="px-2 py-1 border border-green-400 rounded-full text-green-600 font-semibold inline-block mt-1">
                                Đang hoạt động
                            </p>
                        @else
                            <p class="px-2 py-1 border border-red-400 rounded-full text-red-600 font-semibold inline-block mt-1">
                                Ngưng hoạt động
                            </p>
                        @endif
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
