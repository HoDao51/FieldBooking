@extends('admins.layouts.app')

@section('content')
<div class="pl-2 pb-6">
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
        <a href="{{ route('admins.index') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Quay lại
        </a>
    </div>

    <div class="space-y-8">
        @forelse($topTimeSlotsByFacility as $facilityName => $fieldsGroup)
            <div id="facility-{{ collect($fieldsGroup)->first()->first()->facility_id }}" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        Cụm sân: {{ $facilityName }}
                    </h2>
                </div>
                
                <div class="p-6">
                    <div class="space-y-6">
                        @foreach($fieldsGroup as $fieldName => $slots)
                            <div class="border border-gray-200 rounded-xl p-5 bg-gray-50/50">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                    Sân: {{ $fieldName }}
                                </h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-6 gap-4">
                                    @foreach ($slots as $index => $slot)
                                        <div class="bg-white border border-gray-200 rounded-xl p-3 flex flex-col items-center shadow-sm relative overflow-hidden">
                                            <div class="absolute top-0 left-0 w-full h-1 {{ $index < 3 ? 'bg-purple-500' : 'bg-gray-200' }}"></div>
                                            <span class="font-bold text-purple-700 text-base mt-1 tracking-wider">
                                                {{ \Carbon\Carbon::parse($slot->TimeSlot->startTime)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->TimeSlot->endTime)->format('H:i') }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <h3 class="text-xl font-medium text-gray-600">Chưa có dữ liệu đặt sân</h3>
                <p class="text-gray-400 mt-2">Hệ thống chưa ghi nhận lượt đặt sân nào đủ điều kiện thống kê.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
