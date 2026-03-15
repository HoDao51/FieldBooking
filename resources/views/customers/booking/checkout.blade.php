@extends('customers.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex items-center mb-3">
            <a href="{{ route('san.show', $field->id) }}"
                class="flex items-center gap-2 text-gray-500 hover:text-green-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m12 19l-7-7l7-7m7 7H5" />
                </svg>
                <p class="text-gray-500 hover:text-green-600">
                    Quay lại
                </p>
            </a>
        </div>
        <h1 class="text-2xl font-bold mb-6">
            Thanh toán đặt sân
        </h1>

        <div class="grid grid-cols-12 gap-6">
            <!-- LEFT -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="font-semibold mb-4">
                        Thông tin đặt sân
                    </h2>
                    <div class="flex gap-4">
                        <img src="{{ asset('storage/' . $field->images->first()->name) }}"
                            class="w-28 h-20 rounded-lg object-cover">
                        <div>
                            <h3 class="font-semibold">
                                {{ $field->name }}
                            </h3>
                            <p class="text-gray-500 text-sm">
                                {{ $field->address }}
                            </p>
                            @php
                                \Carbon\Carbon::setLocale('vi');
                            @endphp
                            <p class="text-gray-500 text-sm">
                                {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d/m/Y') }}
                            </p>
                            <span class="inline-block mt-2 bg-green-100 text-green-600 text-sm px-3 py-1 rounded-full">
                                {{ $time }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Thông tin người đặt -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="font-bold text-xl mb-4">
                        Thông tin người đặt
                    </h2>

                    <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="field_id" value="{{ $field->id }}">
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="time_id" value="{{ $time_id }}">
                        <input type="hidden" name="price" value="{{ $price }}">

                        <div>
                            <label class="text-base text-gray-500 font-semibold">
                                Họ và tên
                            </label>
                            <input type="text" name="contactName" placeholder="Nhập họ và tên"
                                value="{{ old('contactName', auth()->user()->name ?? '') }}"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400 @error('contactName') border-red-500 @enderror">
                            @error('contactName')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-base text-gray-500 font-semibold">
                                Số điện thoại
                            </label>
                            <input type="text" name="contactPhone" placeholder="Nhập số điện thoại"
                                value="{{ old('contactPhone', auth()->user()->customers->phoneNumber ?? '') }}"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400 @error('contactPhone') border-red-500 @enderror">
                            @error('contactPhone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-base text-gray-500 font-semibold">
                                Email
                            </label>
                            <input type="email" name="contactEmail" placeholder="Nhập email"
                                value="{{ old('contactEmail', auth()->user()->email ?? '') }}"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400 @error('contactEmail') border-red-500 @enderror">
                            @error('contactEmail')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label class="font-semibold">Phương thức thanh toán</label>
                            @foreach ($payments as $payment)
                                <div class="flex items-center mt-2">
                                    <input type="radio" id="payment{{ $payment->id }}" name="payment_id"
                                        value="{{ $payment->id }}" required class="mr-2">
                                    <label for="payment{{ $payment->id }}">{{ $payment->name }}</label>
                                </div>
                            @endforeach
                            @error('payment_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-span-12 lg:col-span-4">
                <div class="bg-white rounded-xl shadow p-6 sticky top-24">
                    <h3 class="font-semibold mb-4">
                        Tóm tắt đơn hàng
                    </h3>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('storage/' . $field->images->first()->name) }}"
                            class="w-12 h-12 rounded-lg object-cover">
                        <div>
                            <p class="font-semibold text-sm">
                                {{ $field->name }}
                            </p>
                            <p class="text-gray-500 text-xs">
                                {{ $field->fieldType->name }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-between text-sm mb-3">
                        <span>{{ $time }}</span>
                        <span>{{ number_format($price, 0, ',', '.') }}đ</span>
                    </div>
                    @error('time_id')
                        <div class="bg-red-50 border-l-4 border-red-400 p-3 mt-2 rounded text-sm text-red-700">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="border-t pt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span>{{ number_format($price, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Phí dịch vụ</span>
                            <span>Miễn phí</span>
                        </div>
                    </div>

                    <div class="border-t pt-4 mt-4 flex justify-between font-semibold">
                        <span class="text-lg">Tổng cộng</span>
                        <span class="text-green-600 font-bold text-2xl">
                            {{ number_format($price, 0, ',', '.') }}đ
                        </span>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 text-white py-3 rounded-lg mt-4 hover:bg-green-700 transition">
                        Xác nhận thanh toán
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
