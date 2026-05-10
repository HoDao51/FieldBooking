@extends('admins.layouts.app')

@section('content')
    <div class="pl-2 max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <a href="{{ route('donDatSan.index') }}" class="hover:text-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <span>Xác nhận hủy đơn đặt sân</span>
            </h1>
            <p class="text-gray-500 mt-1">Vui lòng cung cấp lý do hủy đơn và xác nhận</p>
        </div>

        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Thông tin đơn đặt</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Khách hàng</p>
                    <p class="font-semibold text-gray-800">{{ $booking->contactName }}</p>
                    <p class="text-sm text-gray-600">{{ $booking->contactPhone }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Sân bóng</p>
                    <p class="font-semibold text-gray-800">{{ $booking->Fields->facility->name }}</p>
                    <p class="text-sm text-gray-600">{{ $booking->Fields->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Thời gian đặt</p>
                    <p class="font-semibold text-gray-800">
                        {{ \Carbon\Carbon::parse($booking->bookingDate)->format('d/m/Y') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($booking->TimeSlot->startTime)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($booking->TimeSlot->endTime)->format('H:i') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Số tiền đã thanh toán (Cần hoàn)</p>
                    <p class="font-bold text-red-600 text-xl">{{ number_format($paidAmount) }}đ</p>
                    <p class="text-xs text-gray-500">Tổng tiền đơn: {{ number_format($booking->totalPrice) }}đ</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Lý do hủy đơn</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('donDatSan.cancel', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Nhập lý do hủy đơn (bắt buộc)
                        </label>
                        <textarea 
                            name="reason" 
                            id="reason" 
                            rows="4" 
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-1 focus:ring-red-500 outline-none @error('reason') border-red-500 @enderror"
                            placeholder="Ví dụ: Khách hàng yêu cầu hủy do bận việc đột xuất..."
                            required
                        >{{ old('reason') }}</textarea>
                        @error('reason')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-red-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-red-700 transition">
                            Xác nhận hủy đơn
                        </button>
                        <a href="{{ route('donDatSan.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-300 transition">
                            Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
