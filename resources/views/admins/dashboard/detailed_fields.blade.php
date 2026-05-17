@extends('admins.layouts.app')

@section('content')
<div class="pl-2 pb-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-500" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                <span>Chi tiết Sân được đặt nhiều nhất</span>
            </h1>
            <p class="text-gray-500 mt-1">Danh sách chi tiết xếp hạng số lượt đặt của tất cả các sân theo từng cụm</p>
        </div>
        <a href="{{ route('admins.index') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Quay lại
        </a>
    </div>

    <div class="space-y-8">
        @forelse($mostBookedFields as $facilityName => $fields)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        Cụm sân: {{ $facilityName }}
                    </h2>
                    <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                        {{ count($fields) }} sân
                    </span>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($fields as $index => $stat)
                            <a href="{{ route('sanBong.edit', $stat->Fields->id) }}" class="block relative bg-white border border-gray-200 rounded-xl p-4 hover:shadow-md transition group cursor-pointer">
                                
                                <div class="flex gap-4 h-full">
                                    <div class="w-24 h-24 flex-shrink-0">
                                        @if($stat->Fields->images->count() > 0)
                                            <img src="{{ asset('storage/' . $stat->Fields->images->first()->name) }}" alt="Sân" class="w-full h-full object-cover rounded-lg border border-gray-200 group-hover:opacity-90 transition">
                                        @else
                                            <div class="w-full h-full rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 border border-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1 flex flex-col justify-center min-w-0">
                                        <h3 class="font-bold text-gray-800 text-lg mb-1 leading-tight truncate" title="{{ $stat->Fields->name }}">{{ $stat->Fields->name }}</h3>
                                        <p class="text-sm text-gray-500 mb-2 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                            {{ $stat->Fields->FieldType->name ?? 'N/A' }}
                                        </p>
                                        <div class="mt-auto flex">
                                            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-sm font-bold px-3 py-1 rounded-lg border border-blue-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                {{ $stat->total_bookings }} lượt đặt
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <h3 class="text-xl font-medium text-gray-600">Chưa có dữ liệu đặt sân</h3>
                <p class="text-gray-400 mt-2">Hệ thống chưa ghi nhận lượt đặt sân nào đủ điều kiện thống kê.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
