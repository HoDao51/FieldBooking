@extends('customers.layouts.app')

@section('content')
    <div class="flex items-start max-w-6xl mx-auto mt-5 mb-10 gap-6">
        <div class="w-64 bg-white rounded-xl shadow p-6 text-center flex flex-col">
            <div
                class="w-24 h-24 bg-green-500 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto">
                @if (optional(auth()->user()->customers)->avatar === null)
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
                    class="flex items-center space-x-2 block px-3 py-2 rounded text-green-600 font-semibold bg-green-100">
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

        <div class="flex-1 bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 512 512">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M256 42.667C138.18 42.667 42.667 138.179 42.667 256c0 117.82 95.513 213.334 213.333 213.334c117.822 0 213.334-95.513 213.334-213.334S373.822 42.667 256 42.667m0 384c-94.105 0-170.666-76.561-170.666-170.667S161.894 85.334 256 85.334c94.107 0 170.667 76.56 170.667 170.666S350.107 426.667 256 426.667m26.714-256c0 15.468-11.262 26.667-26.497 26.667c-15.851 0-26.837-11.2-26.837-26.963c0-15.15 11.283-26.37 26.837-26.37c15.235 0 26.497 11.22 26.497 26.666m-48 64h42.666v128h-42.666z" />
                    </svg>
                    <span>Chi tiết giao dịch</span>
                </h2>
                <a href="{{ route('information.transactionHistory') }}"
                    class="text-green-600 hover:text-green-700 font-semibold flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Quay lại
                </a>
            </div>

            <!-- Thông tin sân bóng -->
            <div class="mb-8 bg-gray-50 p-5 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Thông tin sân bóng</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                    <p><span class="w-24 inline-block text-gray-500">Cụm sân:</span> <span
                            class="font-medium">{{ $booking->Fields->facility->name ?? 'N/A' }}</span></p>
                    <p><span class="w-24 inline-block text-gray-500">Sân:</span> <span
                            class="font-medium">{{ $booking->Fields->name }}</span></p>
                    <p><span class="w-24 inline-block text-gray-500">Ngày đặt:</span> <span
                            class="font-medium">{{ \Carbon\Carbon::parse($booking->bookingDate)->format('d/m/Y') }}</span>
                    </p>
                    <p><span class="w-24 inline-block text-gray-500">Khung giờ:</span> <span
                            class="font-medium text-green-600 bg-green-100 px-2 py-0.5 rounded">{{ \Carbon\Carbon::parse($booking->TimeSlot->startTime)->format('H:i') }}
                            - {{ \Carbon\Carbon::parse($booking->TimeSlot->endTime)->format('H:i') }}</span></p>
                </div>
            </div>

            <!-- Lịch sử thanh toán -->
            @if ($booking->Bills->count() > 0 && request('type') !== 'refund')
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Giao dịch thanh toán</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm border border-gray-200">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left border-b border-gray-200 font-medium">Mã GD</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-200 font-medium">Phương thức</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-200 font-medium">Hình thức</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-200 font-medium">Trạng thái</th>
                                    <th class="px-4 py-2 text-right border-b border-gray-200 font-medium">Số tiền</th>
                                    <th class="px-4 py-2 text-right border-b border-gray-200 font-medium">Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking->Bills as $bill)
                                    <tr>
                                        <td class="px-4 py-3 border-b border-gray-200 text-gray-600">#{{ $bill->id }}
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-200">{{ $bill->PaymentMethod->name }}
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-200">
                                            @if ($bill->payment_type == 1)
                                                Đặt cọc 50%
                                            @else
                                                Thanh toán toàn bộ
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-200">
                                            @if ($bill->status == 1)
                                                <span class="text-green-600 font-medium">Thành công</span>
                                            @elseif ($bill->status == 0)
                                                <span class="text-red-600 font-medium">Đã hủy</span>
                                            @else
                                                <span class="text-yellow-600 font-medium">Đang chờ</span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-4 py-3 border-b border-gray-200 text-right font-semibold text-green-600">
                                            {{ number_format($bill->amount) }}đ
                                        </td>
                                        <td class="px-4 py-3 border-b border-gray-200 text-right text-gray-500">
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
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Giao dịch hoàn tiền (Hủy sân)</h3>
                    <div class="bg-red-50 border border-red-100 rounded-lg p-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Số tiền hoàn lại</p>
                                <p class="text-xl font-bold text-red-600">{{ number_format($booking->refund->amount) }}đ
                                </p>
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
@endsection
