@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('donDatSan.index') }}" class="text-gray-600 hover:text-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m12 19l-7-7l7-7m7 7H5" />
                    </svg>
                </a>
                <div class="ml-2">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Xác nhận thanh toán
                    </h1>
                    <p class="mt-1 text-gray-500">
                        Xác nhận phần tiền còn lại của đơn đặt sân
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12">
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Thông tin đơn đặt sân</h2>

                    <!-- Thông tin booking -->
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-800">Khách hàng</span>
                            <span class="font-medium">{{ $booking->contactName }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-800">Sân</span>
                            <span class="font-medium">{{ $booking->Fields->name }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-800">Ngày đặt</span>
                            <span class="font-medium">
                                {{ \Carbon\Carbon::parse($booking->bookingDate)->format('d/m/Y') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-800">Khung giờ</span>
                            <span class="font-medium">
                                {{ \Carbon\Carbon::parse($booking->TimeSlot->startTime)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($booking->TimeSlot->endTime)->format('H:i') }}
                            </span>
                        </div>
                    </div>

                    <!-- Tóm tắt thanh toán -->
                    <div class="mt-6 border-t border-gray-300 pt-4">
                        <h3 class="text-lg font-semibold mb-3">Tóm tắt thanh toán</h3>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-800">Tổng tiền đơn</span>
                                <span class="font-medium">{{ number_format($booking->totalPrice) }}đ</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-800">Đã thanh toán trước</span>
                                <span class="font-medium text-green-600">{{ number_format($paidAmount) }}đ</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-800">Còn lại</span>
                                <span class="font-medium text-red-500">{{ number_format($remainingAmount) }}đ</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-800">Phương thức</span>
                                <span class="font-medium">Thanh toán tiền mặt</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-300 mt-4 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg text-gray-800 font-semibold">Cần thu tại sân</span>
                                <span class="text-2xl font-bold text-green-600">
                                    {{ number_format($remainingAmount) }}đ
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <form action="{{ route('donDatSan.complete', $booking->id) }}" method="POST" class="mt-6">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition font-medium">
                            Xác nhận thanh toán và hoàn thành đơn
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
