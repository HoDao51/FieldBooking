@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">

        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('admins.index') }}" class="text-gray-600 hover:text-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m12 19l-7-7l7-7m7 7H5" />
                    </svg>
                </a>
                <div class="ml-2">
                    <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 16 16"
                            stroke="currentColor" stroke-width="0">
                            <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                d="M5 11.5h4M5 9h6M5 6.5h6m-5.5-4h-2v12h9v-12h-2m-5-1h5l-.625 2h-3.75z" stroke-width="1" />
                        </svg>

                        <span>
                            Đơn hàng ngày {{ $day }}/{{ $month }}/{{ $year }}
                        </span>
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Danh sách các đơn đặt sân trong ngày {{ $day }}/{{ $month }}/{{ $year }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">
                            Khách hàng
                        </th>
                        <th class="px-6 py-3 text-center">
                            Sân
                        </th>
                        <th class="px-6 py-3 text-center">
                            Ngày đặt
                        </th>
                        <th class="px-6 py-3 text-center">
                            Khung giờ
                        </th>
                        <th class="px-6 py-3 text-center">
                            Thanh toán
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($bookings as $item)
                        <tr class="hover:bg-gray-50">
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
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-800">
                                        {{ $item->Fields->facility->name }}
                                    </span>

                                    <span class="text-xs text-gray-500">
                                        {{ $item->Fields->name }}
                                    </span>
                                </div>
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
                                <p class="font-semibold text-green-600">
                                    {{ number_format($item->totalPrice) }}đ
                                </p>

                                @if ($item->Bills->first())
                                    <p class="italic">
                                        {{ $item->Bills->first()->PaymentMethod->name }}
                                    </p>
                                    @if ($item->Bills->first()->payment_type == 1)
                                        <p class="text-xs text-gray-500">
                                            Đặt cọc:
                                            {{ number_format($item->Bills->first()->amount) }}đ
                                        </p>
                                    @else
                                        <p class="text-xs text-gray-500">
                                            Đã thanh toán đủ
                                        </p>
                                    @endif
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">
                                Không có dữ liệu
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

        @include('admins.components.pagination', ['paginator' => $bookings])

    </div>
@endsection
