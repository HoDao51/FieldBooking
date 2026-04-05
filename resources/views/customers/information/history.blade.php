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

                <a href="{{ route('customer.logout') }}"
                    class="flex items-center space-x-2 block px-3 py-2 rounded text-red-600 font-semibold hover:bg-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 32 32">
                        <path fill="currentColor" stroke="none"
                            d="M26 4h2v24h-2zM11.414 20.586L7.828 17H22v-2H7.828l3.586-3.586L10 10l-6 6l6 6z" />
                    </svg>
                    <span>Đăng xuất</span>
                </a>
            </div>
        </div>

        <div class="flex-1 bg-white rounded-xl shadow p-5">
            <h2 class="text-2xl font-bold mb-6">
                Lịch sử đặt sân
            </h2>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3 text-center">Tên sân</th>
                            <th class="px-6 py-3 text-center">Ngày đặt</th>
                            <th class="px-6 py-3 text-center">Khung giờ</th>
                            <th class="px-6 py-3 text-center">Thanh toán</th>
                            <th class="px-6 py-3 text-center">Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($booking as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-center font-medium break-words">
                                    {{ $item->Fields->name }}
                                </td>

                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    {{ $item->created_at->format('d-m-Y') }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->TimeSlot->startTime)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->TimeSlot->endTime)->format('H:i') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <p class="font-semibold text-green-600">{{ number_format($item->totalPrice) }}đ</p>
                                    @if ($item->Bills->first())
                                        <p class="italic break-words">{{ $item->Bills->first()->PaymentMethod->name }}</p>
                                        @if ($item->Bills->first()->payment_type == 1)
                                            <p class="text-xs text-gray-500">Đặt cọc:
                                                {{ number_format($item->Bills->first()->amount) }}đ</p>
                                        @else
                                            <p class="text-xs text-gray-500">Thanh toán đủ</p>
                                        @endif
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if ($item->status == 0)
                                        <span
                                            class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Chờ thanh toán
                                        </span>
                                    @elseif ($item->status == 1)
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Hoàn thành
                                        </span>
                                    @elseif ($item->status == 2)
                                        <span
                                            class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Đã hủy
                                        </span>
                                    @elseif ($item->status == 3)
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Từ chối
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-400">
                                    Chưa đặt sân nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($booking->hasPages())
                <div class="flex justify-center items-center gap-2">
                    @for ($i = 1; $i <= $booking->lastPage(); $i++)
                        @if ($i == $booking->currentPage())
                            <span class="px-4 py-2 bg-green-600 text-white rounded">
                                {{ $i }}
                            </span>
                        @else
                            <a href="{{ $booking->url($i) }}"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor
                </div>
            @endif
        </div>
    </div>
@endsection
