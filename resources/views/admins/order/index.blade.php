@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 16 16" stroke="currentColor"
                    stroke-width="0">
                    <path fill="none" stroke="currentColor" stroke-linejoin="round"
                        d="M5 11.5h4M5 9h6M5 6.5h6m-5.5-4h-2v12h9v-12h-2m-5-1h5l-.625 2h-3.75z" stroke-width="1" />
                </svg>
                <span>Quản lý đơn hàng</span>
            </h1>
            <p class="text-gray-500 mt-1">
                Quản lý và theo dõi các đơn đặt sân
            </p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <!-- Search -->
            <form method="GET" action="{{ route('donDatSan.index') }}" class="flex items-center space-x-2 mb-2">
                <!-- Thanh tìm kiếm -->
                <div class="relative w-[400px] rounded border border-gray-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Tìm kiếm theo tên khách hàng, SĐT, email,..."
                        class="bg-[#F2F2F2] pl-10 pr-3 py-2 rounded w-full d-lg focus:ring-2 focus:ring-green-400 outline-none">
                </div>
                <!-- Nút tìm kiếm -->
                <button type="submit" class="bg-[#D9D9D9] text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    Tìm kiếm
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Khách hàng</th>
                        <th class="px-6 py-3 text-center">Sân</th>
                        <th class="px-6 py-3 text-center">Ngày đặt</th>
                        <th class="px-6 py-3 text-center">Khung giờ</th>
                        <th class="px-6 py-3 text-center">Tổng tiền</th>
                        <th class="px-6 py-3 text-center">Trạng thái</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($booking as $item)
                        <tr class="hover:bg-gray-50">
                            <!-- Tên -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col text-2x1">
                                    <span class="font-semibold text-gray-800">
                                        {{ $item->contactName }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        {{ $item->contactEmail }}
                                    </span>
                                </div>
                            </td>

                            <!-- Sân -->
                            <td class="text-center">
                                {{ $item->fields->name }}
                            </td>

                            <!-- ngày đặt -->
                            <td class="text-center">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>

                            <!-- Khung giờ -->
                            <td class="text-center">
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm w-fit">
                                    {{ \Carbon\Carbon::parse($item->timeSlot->startTime)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->timeSlot->endTime)->format('H:i') }}
                                </span>
                            </td>

                            <!-- Tổng tiền -->
                            <td class="text-center font-semibold text-green-600">
                                {{ number_format($item->totalPrice) }}đ
                            </td>

                            <!-- Trạng thái -->
                            <td class="text-center">
                                @if ($item->status == 0)
                                    <span class="">
                                        Chờ xác nhận
                                    </span>
                                @elseif ($item->status == 1)
                                    <span class="">
                                        Đã xác nhận
                                    </span>
                                @elseif ($item->status == 2)
                                    <span class="">
                                        Đã hủy
                                    </span>
                                @endif
                            </td>

                            <!-- Thao tác -->
                            <td class="border text-center">
                                <form action="{{ route('nhanVien.destroy', $item->id) }}" method="POST"
                                    class="inline-block mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-[#10B981] text-white text-[16px] font-semibold px-[18px] py-2 rounded hover:bg-red-800">
                                        Xác nhận
                                    </button>
                                </form>
                                <form action="{{ route('nhanVien.destroy', $item->id) }}" method="POST"
                                    class="inline-block mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-[#DC2626] text-white text-[16px] font-semibold px-[18px] py-2 rounded hover:bg-red-800 ml-2">
                                        Từ chối
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">
                                Không có dữ liệu
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        @if ($booking->hasPages())
            <div class="flex justify-center items-center gap-2 mt-6">
                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $sanBong->lastPage(); $i++)
                    @if ($i == $sanBong->currentPage())
                        <span class="px-4 py-2 bg-green-600 text-white rounded">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $sanBong->url($i) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            </div>
        @endif
    </div>
@endsection
