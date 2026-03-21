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

        <p class="mt-3 text-base text-gray-500">
            {{ auth()->user()->email }}
        </p>

        <p class="text-base text-gray-500">
            {{ auth()->user()->employees->phoneNumber }}
        </p>

    </div>

    <!-- Main Content -->
    <div class="flex-1 bg-white rounded-xl shadow p-8">

        <h2 class="text-2xl font-bold mb-6">
            Thông tin cá nhân
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Họ tên -->
            <div>
                <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                    Họ và tên
                </label>

                <input type="text" value="{{ auth()->user()->name }}"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Email -->
            <div>
                <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                    Email
                </label>

                <input type="email" value="{{ auth()->user()->email }}" disabled
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Số điện thoại -->
            <div class="md:col-span-2">
                <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                    Số điện thoại
                </label>

                <input type="text"
                    value="{{ auth()->user()->employees->phoneNumber ?? '' }}"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Chức vụ -->
            @if (auth()->user()->role != 0)
            <div>
                <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                    Chức vụ
                </label>

                <input type="text"
                    value="Tài vụ"
                    class="w-full border rounded-lg px-3 py-2">
            </div>
            @endif

            <!-- Tình trạng -->
            <div class="md:col-span-2">
                <label class="pt-0 label label-text font-semibold text-[#1f2937]">
                    Tình trạng
                </label>

                @if (auth()->user()->employees->status == 0)
                    <p class="mt-2 text-green-600 font-semibold">Đang hoạt động</p>
                @else
                    <p class="mt-2 text-red-600 font-semibold">Ngưng hoạt động</p>
                @endif
            </div>

        </div>

        <!-- Button -->
        <div class="flex mt-6 gap-3">
            <a href="{{ route('admins.index') }}">
                <button
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-600 transition">
                    Quay lại
                </button>
            </a>

            @if (auth()->user()->role == 0)
                <a href="">
                    <button
                        class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                        Chỉnh sửa
                    </button>
                </a>
            @endif
        </div>

    </div>
</div>
@endsection