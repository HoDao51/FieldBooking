@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v5l3 2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M22 12a10 10 0 1 1-3.2-7.3" />
                </svg>
                <span>Lịch sử giao dịch</span>
            </h1>

            <p class="text-gray-500 mt-1">
                Theo dõi giao dịch thanh toán của khách hàng
            </p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <form method="GET" action="{{ route('lichSuGiaoDich.index') }}" class="flex items-center space-x-2 mb-2">
                <div class="relative w-[400px] rounded border border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Tìm theo tên khách hàng, SĐT, email..."
                        class="bg-[#F2F2F2] pl-10 pr-3 py-2 rounded w-full focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <button type="submit"
                    class="bg-[#D9D9D9] text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition whitespace-nowrap">
                    Tìm kiếm
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Khách hàng</th>
                        <th class="px-6 py-3 text-center">Sân</th>
                        <th class="px-6 py-3 text-center">Khung giờ</th>
                        <th class="px-6 py-3 text-center">Phương thức</th>
                        <th class="px-6 py-3 text-center">Hình thức</th>
                        <th class="px-6 py-3 text-center">Số tiền</th>
                        <th class="px-6 py-3 text-center">Trạng thái</th>
                        <th class="px-6 py-3 text-center">Thời gian</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($bills as $bill)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-800">
                                        {{ $bill->Booking->contactName }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $bill->Booking->contactEmail }}
                                    </span>
                                </div>
                            </td>

                            <td class="text-center">
                                {{ $bill->Booking->Fields->name }}
                            </td>

                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($bill->Booking->TimeSlot->startTime)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($bill->Booking->TimeSlot->endTime)->format('H:i') }}
                            </td>

                            <td class="text-center">
                                {{ $bill->PaymentMethod->name }}
                            </td>

                            <td class="text-center">
                                @if ($bill->payment_type == 1)
                                    Đặt cọc 50%
                                @else
                                    Thanh toán toàn bộ
                                @endif
                            </td>

                            <td class="text-center font-semibold text-green-600">
                                {{ number_format($bill->amount) }}đ
                            </td>

                            <td class="text-center">
                                @if ($bill->status == 1)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Đã thanh toán
                                    </span>
                                @elseif ($bill->status == 2)
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Thất bại
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Chờ thanh toán
                                    </span>
                                @endif
                            </td>

                            <td class="text-center whitespace-nowrap">
                                @if ($bill->paid_at)
                                    {{ \Carbon\Carbon::parse($bill->paid_at)->format('d/m/Y H:i') }}
                                @else
                                    {{ $bill->created_at->format('d/m/Y H:i') }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-500">
                                Không có dữ liệu giao dịch
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($bills->hasPages())
            <div class="flex justify-center items-center gap-2 mt-6">
                @for ($i = 1; $i <= $bills->lastPage(); $i++)
                    @if ($i == $bills->currentPage())
                        <span class="px-4 py-2 bg-green-600 text-white rounded">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $bills->url($i) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            </div>
        @endif
    </div>
@endsection
