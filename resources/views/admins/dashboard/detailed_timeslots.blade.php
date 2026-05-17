@extends('admins.layouts.app')

@section('content')
<div class="pl-2">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-500" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                </svg>
                <span>Chi tiết Khung giờ phổ biến</span>
            </h1>
            <p class="text-gray-500 mt-1">Danh sách tất cả các khung giờ được đặt theo từng cụm sân</p>
        </div>
        <a href="{{ route('admins.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition">
            Quay lại
        </a>
    </div>

    <div class="bg-white rounded-xl shadow border border-gray-200 p-5">
        @forelse($topTimeSlotsByFacility as $facilityName => $slots)
            <div class="mb-6 last:mb-0">
                <h2 class="text-lg font-bold text-gray-800 bg-gray-100 px-4 py-2 rounded-t-lg border-l-4 border-purple-500">
                    Cụm sân: {{ $facilityName }}
                </h2>
                <div class="border border-t-0 border-gray-200 rounded-b-lg p-4 bg-white">
                    <div class="flex flex-wrap gap-3">
                        @foreach ($slots as $slot)
                            <div class="bg-purple-50 border border-purple-200 rounded-lg px-4 py-2 flex flex-col items-center shadow-sm">
                                <span class="font-bold text-purple-700 text-lg">
                                    {{ \Carbon\Carbon::parse($slot->TimeSlot->startTime)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->TimeSlot->endTime)->format('H:i') }}
                                </span>
                                <span class="text-sm text-gray-500 mt-1">
                                    {{ $slot->total_bookings }} lượt đặt
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                Chưa có dữ liệu đặt sân
            </div>
        @endforelse
    </div>
</div>
@endsection
