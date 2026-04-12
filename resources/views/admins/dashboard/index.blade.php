@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" fill="#222C3A" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="0">
                    <path fill="currentColor"
                        d="M6 15H2c-.6 0-1 .4-1 1v6c0 .6.4 1 1 1h4c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1m8-6h-4c-.6 0-1 .4-1 1v12c0 .6.4 1 1 1h4c.6 0 1-.4 1-1V10c0-.6-.4-1-1-1m8-8h-4c-.6 0-1 .4-1 1v20c0 .6.4 1 1 1h4c.6 0 1-.4 1-1V2c0-.6-.4-1-1-1" />
                </svg>
                <span>Thống kê</span>
            </h1>

            <p class="text-gray-500 mt-1">
                Thống kê doanh thu và hiển thị tổng quan hệ thống
            </p>
        </div>

        <div class="flex-1 flex flex-col">
            <main class="overflow-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4 min-w-0">
                        <div class="bg-blue-100 p-3 rounded-lg text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 36 36"
                                stroke="currentColor" stroke-width="0">
                                <path fill="currentColor"
                                    d="M18.42 16.31a5.7 5.7 0 1 1 5.76-5.7a5.74 5.74 0 0 1-5.76 5.7m0-9.4a3.7 3.7 0 1 0 3.76 3.7a3.74 3.74 0 0 0-3.76-3.7" />
                                <path fill="currentColor"
                                    d="M18.42 16.31a5.7 5.7 0 1 1 5.76-5.7a5.74 5.74 0 0 1-5.76 5.7m0-9.4a3.7 3.7 0 1 0 3.76 3.7a3.74 3.74 0 0 0-3.76-3.7m3.49 10.74a20.6 20.6 0 0 0-13 2a1.77 1.77 0 0 0-.91 1.6v3.56a1 1 0 0 0 2 0v-3.43a18.92 18.92 0 0 1 12-1.68Z" />
                                <path fill="currentColor"
                                    d="M33 22h-6.7v-1.48a1 1 0 0 0-2 0V22H17a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V23a1 1 0 0 0-1-1m-1 10H18v-8h6.3v.41a1 1 0 0 0 2 0V24H32Z" />
                                <path fill="currentColor"
                                    d="M21.81 27.42h5.96v1.4h-5.96zM10.84 12.24a18 18 0 0 0-7.95 2A1.67 1.67 0 0 0 2 15.71v3.1a1 1 0 0 0 2 0v-2.9a16 16 0 0 1 7.58-1.67a7.3 7.3 0 0 1-.74-2m22.27 1.99a17.8 17.8 0 0 0-7.12-2a7.5 7.5 0 0 1-.73 2A15.9 15.9 0 0 1 32 15.91v2.9a1 1 0 1 0 2 0v-3.1a1.67 1.67 0 0 0-.89-1.48m-22.45-3.62v-.67a3.07 3.07 0 0 1 .54-6.11a3.15 3.15 0 0 1 2.2.89a8.2 8.2 0 0 1 1.7-1.08a5.13 5.13 0 0 0-9 3.27a5.1 5.1 0 0 0 4.7 5a7.4 7.4 0 0 1-.14-1.3m14.11-8.78a5.17 5.17 0 0 0-3.69 1.55a8 8 0 0 1 1.9 1a3.14 3.14 0 0 1 4.93 2.52a3.09 3.09 0 0 1-1.79 2.77a7 7 0 0 1 .06.93a8 8 0 0 1-.1 1.2a5.1 5.1 0 0 0 3.83-4.9a5.12 5.12 0 0 0-5.14-5.07" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-700 leading-none">
                                {{ $customers }}
                            </h2>
                            <p class="text-gray-500 text-sm mt-1">
                                Tổng khách hàng
                            </p>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4 min-w-0">
                        <div class="bg-purple-100 p-3 text-purple-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 256 256"
                                stroke="currentColor" stroke-width="3">
                                <path fill="currentColor"
                                    d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-700 leading-none">
                                {{ $fields }}
                            </h2>
                            <p class="text-gray-500 text-sm mt-1">
                                Tổng sân
                            </p>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4 min-w-0">
                        <div class="bg-yellow-100 p-3 rounded-lg text-yellow-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#222C3A" viewBox="0 0 16 16"
                                stroke="currentColor" stroke-width="0">
                                <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                    d="M5 11.5h4M5 9h6M5 6.5h6m-5.5-4h-2v12h9v-12h-2m-5-1h5l-.625 2h-3.75z"
                                    stroke-width="1" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-700 leading-none">
                                {{ $bookings }}
                            </h2>
                            <p class="text-gray-500 text-sm mt-1">
                                Đơn đặt hôm nay
                            </p>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4 min-w-0">
                        <div class="bg-green-100 p-3 rounded-lg text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 scale-125 opacity-80" viewBox="0 0 56 56"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M29 30v10c3.519-.316 5-2.287 5-4.89c0-2.507-1.152-3.99-5-5.11m-3-5v-9c-3.273.415-5 2.33-5 4.43s1.364 3.647 5 4.57m2.84.737l1.072.277C35.784 27.423 39 29.917 39 34.836c0 5.658-4.466 8.868-10.16 9.284V48h-2.523v-3.88c-5.672-.439-10.16-3.741-10.317-9.284h4.622c.402 2.702 2.1 4.688 5.695 5.08V29.849l-.916-.231c-5.672-1.363-8.731-3.996-8.731-8.684c0-5.173 4.02-8.591 9.647-9.03V8h2.523v3.903c5.582.462 9.624 3.926 9.803 9.169h-4.645c-.29-2.91-2.3-4.596-5.158-4.966z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h2 class="text-lg xl:text-2xl font-bold text-green-600 leading-tight break-all"
                                title="{{ number_format($revenue) }}đ">
                                {{ $formattedRevenue }}
                            </h2>
                            <p class="text-gray-500 text-sm mt-1">
                                Doanh thu
                            </p>
                        </div>
                    </div>
                </div>

                <h2 class="flex items-center gap-3 text-xl font-bold text-gray-800 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 16 16"
                        stroke="currentColor" stroke-width="0">
                        <path fill="none" stroke="currentColor" stroke-linejoin="round"
                            d="M5 11.5h4M5 9h6M5 6.5h6m-5.5-4h-2v12h9v-12h-2m-5-1h5l-.625 2h-3.75z" stroke-width="1" />
                    </svg>
                    <span>Danh sách các đơn đặt sân mới</span>
                </h2>

                <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3 text-left">Khách hàng</th>
                                <th class="px-6 py-3 text-center">Sân</th>
                                <th class="px-6 py-3 text-center">Ngày đặt</th>
                                <th class="px-6 py-3 text-center">Khung giờ</th>
                                <th class="px-6 py-3 text-center">Thanh toán</th>
                                <th class="px-6 py-3 text-center">Trạng thái</th>
                                <th class="px-6 py-3 text-center">Thao tác</th>
                            </tr>
                        </thead>

                <tbody class="divide-y divide-gray-200">
                            @forelse($booking as $item)
                                <tr class="hover:bg-gray-50 border-gray-200">
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-800">
                                                {{ $item->contactName }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ $item->contactEmail }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        {{ $item->Fields->name }}
                                    </td>

                                    <td class="text-center whitespace-nowrap">
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </td>

                                    <td class="text-center">
                                        <span
                                            class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($item->TimeSlot->startTime)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($item->TimeSlot->endTime)->format('H:i') }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <p class="font-semibold text-green-600">{{ number_format($item->totalPrice) }}đ</p>
                                        @if ($item->Bills->first())
                                            <p class="italic">{{ $item->Bills->first()->PaymentMethod->name }}</p>
                                            @if ($item->Bills->first()->payment_type == 1)
                                                <p class="text-xs text-gray-500">Đặt cọc:
                                                    {{ number_format($item->Bills->first()->amount) }}đ</p>
                                            @else
                                                <p class="text-xs text-gray-500">Thanh toán đủ</p>
                                            @endif
                                        @endif
                                    </td>

                                    <td class="text-center whitespace-nowrap">
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
                                        @endif
                                    </td>

                                    <td class="border border-gray-200 text-center px-2 whitespace-nowrap">
                                        @if ($item->status == 0)
                                            <form action="{{ route('donDatSan.complete', $item->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('PUT')
                                                <button
                                                    class="bg-blue-600 font-semibold text-white px-2 py-2 rounded hover:bg-blue-700">
                                                    Hoàn thành
                                                </button>
                                            </form>

                                            <form action="{{ route('donDatSan.cancel', $item->id) }}" method="POST"
                                                class="inline-block ml-2">
                                                @csrf
                                                @method('PUT')
                                                <button
                                                    class="bg-gray-600 font-semibold text-white px-2 py-2 rounded hover:bg-gray-700">
                                                    Hủy
                                                </button>
                                            </form>
                                        @elseif ($item->status == 1)
                                            <span class="text-green-600 font-semibold">
                                                Đã hoàn thành
                                            </span>
                                        @elseif ($item->status == 2)
                                            <span class="text-gray-500 font-semibold">
                                                Đã hủy
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500">
                                        Không có dữ liệu
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($booking->hasPages())
                    <div class="flex justify-center items-center gap-2 mt-6">
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
            </main>
        </div>
    </div>
@endsection
