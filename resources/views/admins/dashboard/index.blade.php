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

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
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
                            d="M5 11.5h4M5 9h6M5 6.5h6m-5.5-4h-2v12h9v-12h-2m-5-1h5l-.625 2h-3.75z" stroke-width="1" />
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
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
            <!-- Doanh thu theo tháng -->
            <div class="bg-white rounded-xl shadow border border-gray-200 p-5">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-400 pb-2">Doanh thu năm {{ $currentYear }}</h2>
                <div class="relative h-72">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>

            <!-- Doanh thu theo ngày -->
            <div class="bg-white rounded-xl shadow border border-gray-200 p-5">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-400 pb-2">Doanh thu tháng {{ $currentMonth }}/{{ $currentYear }}</h2>
                <div class="relative h-72">
                    <canvas id="dailyChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
            <!-- Top Sân -->
            <div class="bg-white rounded-xl shadow border border-gray-200 p-5">
                <h2 class="flex items-center justify-between gap-2 text-xl font-bold text-gray-800 mb-4 border-b border-gray-400 pb-2">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        Sân được đặt nhiều nhất
                    </span>
                    <a href="{{ route('thongKe.san') }}" class="text-sm font-normal text-blue-600 hover:underline">Xem chi tiết</a>
                </h2>
                <div class="space-y-4">
                    @forelse($mostBookedFields as $index => $stat)
                        <a href="{{ route('sanBong.edit', $stat->Fields->id) }}" class="block flex items-center gap-4 p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-gray-100 transition shadow-sm cursor-pointer">
                            <div class="flex-shrink-0 relative">
                                @if($stat->Fields->images->count() > 0)
                                    <img src="{{ asset('storage/' . $stat->Fields->images->first()->name) }}" alt="Sân" class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-800 text-base truncate">{{ $stat->Fields->name }}</h3>
                                <p class="text-sm text-gray-500 truncate flex items-center gap-1">
                                    <span class="font-medium">Cụm:</span> {{ $stat->facility_name ?? 'N/A' }}
                                </p>
                                <p class="text-xs text-blue-600 mt-1 font-medium bg-blue-100 inline-block px-2 py-0.5 rounded">{{ $stat->Fields->FieldType->name ?? 'N/A' }}</p>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <span class="bg-blue-50 text-blue-700 text-sm font-bold px-3 py-1.5 rounded-lg border border-blue-200 whitespace-nowrap shadow-sm">
                                    {{ $stat->total_bookings }} lượt
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="py-8 text-gray-500 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">Chưa có dữ liệu đặt sân</div>
                    @endforelse
                </div>
            </div>

            <!-- Top Khung giờ theo cụm -->
            <div class="bg-white rounded-xl shadow border border-gray-200 p-5">
                <h2 class="flex items-center justify-between gap-2 text-xl font-bold text-gray-800 mb-4 border-b border-gray-400 pb-2">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-500" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                        </svg>
                        Khung giờ phổ biến theo Cụm sân
                    </span>
                    <a href="{{ route('thongKe.khungGio') }}" class="text-sm font-normal text-purple-600 hover:underline">Xem chi tiết</a>
                </h2>
                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2">
                    @forelse($topTimeSlotsByFacility as $facilityName => $slots)
                        <div>
                            <h3
                                class="font-semibold text-gray-700 bg-gray-100 px-3 py-2 rounded mb-2 border-l-4 border-purple-500">
                                {{ $facilityName }}</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($slots as $slot)
                                    <div
                                        class="bg-green-50 border border-green-200 rounded-lg px-3 py-1.5 text-sm flex items-center gap-2 shadow-sm">
                                        <span
                                            class="font-medium text-green-700">{{ \Carbon\Carbon::parse($slot->TimeSlot->startTime)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($slot->TimeSlot->endTime)->format('H:i') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500 text-center py-4">Chưa có dữ liệu đặt sân</div>
                    @endforelse
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
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->TimeSlot->startTime)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->TimeSlot->endTime)->format('H:i') }}
                                </span>
                            </td>

                            <td class="text-center">
                                <p class="font-semibold text-green-600">{{ number_format($item->totalPrice) }}đ
                                </p>
                                @if ($item->Bills->first())
                                    <p class="italic">{{ $item->Bills->first()->PaymentMethod->name }}</p>
                                    @if ($item->Bills->first()->payment_type == 1)
                                        <p class="text-xs text-gray-500">Đặt cọc:
                                            {{ number_format($item->Bills->first()->amount) }}đ</p>
                                    @else
                                        <p class="text-xs text-gray-500">Đã thanh toán đủ</p>
                                    @endif
                                @endif
                            </td>

                            <td class="text-center whitespace-nowrap">
                                @if ($item->status == 0)
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Chờ thanh toán
                                    </span>
                                @elseif ($item->status == 1)
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Đã thanh toán
                                    </span>
                                @elseif ($item->status == 2)
                                    <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Đã hủy
                                    </span>
                                @elseif ($item->status == 3)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Hoàn thành
                                    </span>
                                @endif
                            </td>

                            <td class="border border-gray-200 text-center px-2 whitespace-nowrap">
                                @if ($item->status == 0)
                                    <a href="{{ route('donDatSan.completePage', $item->id) }}"
                                        class="inline-block bg-blue-600 font-semibold text-white px-2 py-2 rounded hover:bg-blue-700">
                                        Hoàn thành
                                    </a>

                                    <a href="{{ route('donDatSan.cancelPage', $item->id) }}"
                                        class="inline-block ml-2 bg-gray-600 font-semibold text-white px-2 py-2 rounded hover:bg-gray-700">
                                        Hủy
                                    </a>
                                @elseif ($item->status == 1)
                                    <a href="{{ route('donDatSan.cancelPage', $item->id) }}"
                                        class="inline-block ml-2 bg-gray-600 font-semibold text-white px-2 py-2 rounded hover:bg-gray-700">
                                        Hủy
                                    </a>
                                @elseif ($item->status == 2)
                                    <span class="text-gray-500 font-semibold">
                                        Đã hủy
                                    </span>
                                @elseif ($item->status == 3)
                                    <span class="text-green-600 font-semibold">
                                        Hoàn thành
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const monthlyLabels = {!! json_encode(array_map(function($m) { return 'Tháng ' . $m; }, array_keys($monthlyRevenues))) !!};
            const monthlyData = {!! json_encode(array_values($monthlyRevenues)) !!};

            const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
            new Chart(ctxMonthly, {
                type: 'bar',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        label: 'Doanh thu',
                        data: monthlyData,
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    if(value >= 1000000) return value / 1000000 + 'M';
                                    if(value >= 1000) return value / 1000 + 'K';
                                    return value;
                                }
                            }
                        }
                    }
                }
            });

            const dailyLabels = {!! json_encode(array_map(function($d) { return 'Ngày ' . $d; }, array_keys($dailyRevenues))) !!};
            const dailyData = {!! json_encode(array_values($dailyRevenues)) !!};

            const ctxDaily = document.getElementById('dailyChart').getContext('2d');
            new Chart(ctxDaily, {
                type: 'line',
                data: {
                    labels: dailyLabels,
                    datasets: [{
                        label: 'Doanh thu',
                        data: dailyData,
                        backgroundColor: 'rgba(16, 185, 129, 0.2)',
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: 'rgb(16, 185, 129)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    if(value >= 1000000) return value / 1000000 + 'M';
                                    if(value >= 1000) return value / 1000 + 'K';
                                    return value;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
