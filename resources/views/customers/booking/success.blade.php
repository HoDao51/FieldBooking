@extends('customers.layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto pb-12 pt-4">
        <div class="text-center mb-2">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-green-600" viewBox="0 0 16 16">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                        <path
                            d="m14.25 8.75c-.5 2.5-2.3849 4.85363-5.03069 5.37991-2.64578.5263-5.33066-.7044-6.65903-3.0523-1.32837-2.34784-1.00043-5.28307.81336-7.27989 1.81379-1.99683 4.87636-2.54771 7.37636-1.54771" />
                        <polyline points="5.75 7.75 8.25 10.25 14.25 3.75" />
                    </g>
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-green-600 mt-2">
                Đặt sân thành công!
            </h1>

            <p class="text-gray-600">
                Đơn đặt sân của bạn đã được ghi nhận.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-4 max-w-xl mx-auto">
            <div class="flex gap-4 mb-4">
                @if ($booking->Fields->images->first())
                    <img src="{{ asset('storage/' . $booking->Fields->images->first()->name) }}"
                        class="w-24 h-20 rounded-lg object-cover">
                @else
                    <img src="{{ asset('images/banner-client-placeholder.jpg') }}"
                        class="w-20 h-16 rounded-lg object-cover">
                @endif

                <div>
                    <h1 class="font-bold text-lg">
                        {{ $booking->Fields->name }}
                    </h1>

                    <div class="flex items-start gap-1 text-gray-500 text-sm my-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600 mt-0.5 shrink-0"
                            viewBox="0 0 256 256" stroke="currentColor" stroke-width="3">
                            <path fill="currentColor"
                                d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                        </svg>
                        <span>{{ $booking->Fields->address }}</span>
                    </div>

                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm mt-2">
                        {{ $booking->Fields->FieldType->name }}
                    </span>
                </div>
            </div>

            <div class="border-t pt-4 space-y-3 text-base">
                <div class="flex justify-between">
                    <span class="flex items-center gap-2 text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="0">
                            <path fill="currentColor"
                                d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                        </svg>
                        Ngày đặt
                    </span>
                    <span class="font-semibold">
                        {{ \Carbon\Carbon::parse($booking->bookingDate)->locale('vi')->translatedFormat('l, d/m/Y') }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex flex-col gap-1">
                        <span class="flex items-center gap-2 text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="0.5">
                                <path fill="currentColor"
                                    d="M11.5 3a9.5 9.5 0 0 1 9.5 9.5a9.5 9.5 0 0 1-9.5 9.5A9.5 9.5 0 0 1 2 12.5A9.5 9.5 0 0 1 11.5 3m0 1A8.5 8.5 0 0 0 3 12.5a8.5 8.5 0 0 0 8.5 8.5a8.5 8.5 0 0 0 8.5-8.5A8.5 8.5 0 0 0 11.5 4M11 7h1v5.42l4.7 2.71l-.5.87l-5.2-3z" />
                            </svg>
                            Khung giờ
                        </span>
                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm w-fit">
                            {{ \Carbon\Carbon::parse($booking->TimeSlot->startTime)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($booking->TimeSlot->endTime)->format('H:i') }}
                        </span>
                    </div>

                    <span class="text-sm font-semibold">
                        {{ number_format($booking->totalPrice) }}đ
                    </span>
                </div>

                @if ($booking->Bills->first())
                    <div class="flex justify-between">
                        <span class="flex items-center gap-2 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <rect width="20" height="14" x="2" y="5" rx="2" />
                                    <path d="M2 10h20" />
                                </g>
                            </svg>
                            Phương thức thanh toán
                        </span>
                        <span class="font-semibold">
                            {{ $booking->Bills->first()->PaymentMethod->name }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm">Hình thức</span>
                        <span class="font-semibold">
                            @if ($booking->Bills->first()->payment_type == 1)
                                Đặt cọc 50%
                            @else
                                Thanh toán toàn bộ
                            @endif
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm">Đã thanh toán</span>
                        <span class="font-semibold text-green-600">
                            {{ number_format($booking->Bills->first()->amount) }}đ
                        </span>
                    </div>
                @endif
            </div>

            <div class="border-t mt-6 pt-4 flex justify-between font-semibold">
                <span class="text-lg">Tổng tiền</span>
                <span class="text-green-600 text-2xl font-bold">
                    {{ number_format($booking->totalPrice) }}đ
                </span>
            </div>
        </div>

        <div class="flex justify-center gap-4 mt-6">
            <a href="{{ route('san.index') }}"
                class="bg-gray-600 font-medium text-white px-6 py-3 rounded-lg hover:bg-gray-700">
                Quay về trang chủ
            </a>

            <a href="{{ route('information.history') }}"
                class="bg-green-600 font-medium text-white px-6 py-3 rounded-lg hover:bg-green-700">
                Xem lịch sử đặt sân
            </a>
        </div>
    </div>
@endsection
