@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" fill="none" viewBox="0 0 512 512">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M256 42.667C138.18 42.667 42.667 138.179 42.667 256c0 117.82 95.513 213.334 213.333 213.334c117.822 0 213.334-95.513 213.334-213.334S373.822 42.667 256 42.667m0 384c-94.105 0-170.666-76.561-170.666-170.667S161.894 85.334 256 85.334c94.107 0 170.667 76.56 170.667 170.666S350.107 426.667 256 426.667m26.714-256c0 15.468-11.262 26.667-26.497 26.667c-15.851 0-26.837-11.2-26.837-26.963c0-15.15 11.283-26.37 26.837-26.37c15.235 0 26.497 11.22 26.497 26.666m-48 64h42.666v128h-42.666z" />
                    </svg>
                    <span>Chi tiết giao dịch</span>
                </h1>
                <p class="text-gray-500 mt-1">
                    Thông tin chi tiết các khoản thanh toán
                </p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden max-w-4xl">
            <a href="{{ route('lichSuGiaoDich.index') }}"
                class="flex items-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Quay lại
            </a>
            <div class="p-6 sm:p-8">
                <!-- Thông tin khách hàng & Sân -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Thông tin khách
                            hàng</h3>
                        <div class="space-y-3">
                            <p><span class="text-gray-500 w-32 inline-block">Họ và tên:</span> <span
                                    class="font-medium text-gray-800">{{ $booking->contactName }}</span></p>
                            <p><span class="text-gray-500 w-32 inline-block">Số điện thoại:</span> <span
                                    class="font-medium text-gray-800">{{ $booking->contactPhone }}</span></p>
                            <p><span class="text-gray-500 w-32 inline-block">Email:</span> <span
                                    class="font-medium text-gray-800">{{ $booking->contactEmail }}</span></p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Thông tin sân
                            bóng</h3>
                        <div class="space-y-3">
                            <p><span class="text-gray-500 w-32 inline-block">Cụm sân:</span> <span
                                    class="font-medium text-gray-800">{{ $booking->Fields->facility->name ?? 'N/A' }}</span>
                            </p>
                            <p><span class="text-gray-500 w-32 inline-block">Sân:</span> <span
                                    class="font-medium text-gray-800">{{ $booking->Fields->name }}</span></p>
                            <p><span class="text-gray-500 w-32 inline-block">Ngày đặt:</span> <span
                                    class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($booking->bookingDate)->format('d/m/Y') }}</span>
                            </p>
                            <p><span class="text-gray-500 w-32 inline-block">Khung giờ:</span> <span
                                    class="font-medium text-green-600 bg-green-50 px-2 py-1 rounded">{{ \Carbon\Carbon::parse($booking->TimeSlot->startTime)->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($booking->TimeSlot->endTime)->format('H:i') }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Lịch sử thanh toán -->
                @if ($booking->Bills->count() > 0 && request('type') !== 'refund')
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Giao dịch thanh
                            toán</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm border border-gray-200">
                                <thead class="bg-gray-50 text-gray-700 text-center border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 py-2">Mã GD</th>
                                        <th class="px-4 py-2">Phương thức</th>
                                        <th class="px-4 py-2">Hình thức</th>
                                        <th class="px-4 py-2">Trạng thái</th>
                                        <th class="px-4 py-2">Số tiền</th>
                                        <th class="px-4 py-2">Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center border-b border-gray-200">
                                    @foreach ($booking->Bills as $bill)
                                        <tr>
                                            <td class="px-4 py-3 text-gray-600">
                                                #{{ $bill->id }}</td>
                                            <td class="px-4 py-3">{{ $bill->PaymentMethod->name }}
                                            </td>
                                            <td class="px-4 py-3">
                                                @if ($bill->payment_type == 1)
                                                    Đặt cọc 50%
                                                @else
                                                    Thanh toán toàn bộ
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                @if ($bill->status == 1)
                                                    <span class="text-green-600 font-medium">Thành công</span>
                                                @elseif ($bill->status == 0)
                                                    <span class="text-red-600 font-medium">Đã hủy</span>
                                                @else
                                                    <span class="text-yellow-600 font-medium">Đang chờ</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 font-semibold text-green-600">
                                                {{ number_format($bill->amount) }}đ
                                            </td>
                                            <td class="px-4 py-3 text-gray-500">
                                                @if ($bill->paid_at)
                                                    {{ \Carbon\Carbon::parse($bill->paid_at)->format('d/m/Y H:i') }}
                                                @else
                                                    {{ $bill->created_at->format('d/m/Y H:i') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Giao dịch hoàn tiền -->
                @if ($booking->refund && request('type') !== 'bill')
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Giao dịch hoàn
                            tiền (Hủy sân)</h3>
                        <div class="bg-red-50 border border-red-100 rounded-lg p-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Số tiền hoàn lại</p>
                                    <p class="text-xl font-bold text-red-600">
                                        {{ number_format($booking->refund->amount) }}đ</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Thời gian hủy</p>
                                    <p class="text-gray-800 font-medium">
                                        {{ $booking->refund->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-500 mb-1">Lý do hủy</p>
                                    <p class="text-gray-800 bg-white p-3 rounded border border-red-100">
                                        {{ $booking->refund->reason }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
