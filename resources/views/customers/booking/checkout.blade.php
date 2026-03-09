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
                        <input type="hidden" name="time" value="{{ $time }}">
                        <input type="hidden" name="price" value="{{ $price }}">

                        <div>
                            <label class="text-sm text-gray-500">
                                Họ và tên
                            </label>
                            <input type="text" name="contactName" placeholder="Nhập họ và tên"
                                class="border rounded-lg w-full px-4 py-2 mt-1">
                        </div>

                        <div>
                            <label class="text-sm text-gray-500">
                                Số điện thoại
                            </label>
                            <input type="text" name="contactPhone" placeholder="Nhập số điện thoại"
                                class="border rounded-lg w-full px-4 py-2 mt-1">
                        </div>

                        <div>
                            <label class="text-sm text-gray-500">
                                Email
                            </label>
                            <input type="text" name="contactEmail" placeholder="Nhập email"
                                class="border rounded-lg w-full px-4 py-2 mt-1">
                        </div>

                        <div class="mt-4">
                            <label class="font-semibold">Phương thức thanh toán</label>
                            @foreach ($payments as $payment)
                                <div class="flex items-center mt-2">
                                    <input type="radio" name="payment_id" value="{{ $payment->id }}" required
                                        class="mr-2">
                                    <span>{{ $payment->name }}</span>
                                </div>
                            @endforeach
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
                        <span>{{ number_format($price) }}đ</span>
                    </div>

                    <div class="border-t pt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span>{{ number_format($price) }}đ</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Phí dịch vụ</span>
                            <span>Miễn phí</span>
                        </div>
                    </div>

                    <div class="border-t pt-4 mt-4 flex justify-between font-semibold">
                        <span class="text-lg">Tổng cộng</span>
                        <span class="text-green-600 font-bold text-2xl">
                            {{ number_format($price) }}đ
                        </span>
                    </div>
                    <button class="w-full bg-green-600 text-white py-3 rounded-lg mt-4 hover:bg-green-700">
                        Xác nhận thanh toán
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
