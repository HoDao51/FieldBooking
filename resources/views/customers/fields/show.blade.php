@extends('customers.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-12 gap-6">
            <!-- LEFT -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <div class="bg-white rounded-xl shadow p-3">
                    @if ($field->images->count() > 0)
                        <div class="grid grid-cols-3 gap-3">
                            @foreach ($field->images()->limit(3)->get() as $image)
                                <img src="{{ asset('storage/' . $image->name) }}"
                                    class="h-48 w-full object-cover rounded-lg hover:scale-105 transition">
                            @endforeach
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-1">
                            <img src="{{ asset('images/banner-client-placeholder.jpg') }}"
                                class="h-48 w-full object-cover rounded-lg hover:scale-105 transition">
                        </div>
                    @endif
                </div>

                <!-- Thông tin sân -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold">
                                {{ $field->name }}
                            </h1>
                            <div class="flex items-center gap-2 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600 shrink-0"
                                    viewBox="0 0 256 256" stroke="currentColor" stroke-width="3">
                                    <path fill="currentColor"
                                        d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                                </svg>
                                <span> {{ $field->address }} </span>
                            </div>
                        </div>
                        <span class="bg-green-100 font-medium text-green-600 px-3 py-1 rounded-full text-sm">
                            {{ $field->fieldType->name }}
                        </span>
                    </div>

                    @php
                        $linkedFields = $field->conflicts->merge($field->reverseConflicts)->unique('id')->values();
                    @endphp

                    @if ($linkedFields->count() > 0)
                        <div class="mt-4 rounded-xl border border-yellow-200 bg-yellow-50 px-4 py-3">
                            <p class="flex item-center gap-2 text-sm font-semibold text-yellow-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20">
                                    <path fill="currentColor" d="M2.93 17.07A10 10 0 1 1 17.07 2.93A10 10 0 0 1 2.93 17.07M9 5v6h2V5zm0 8v2h2v-2z"/>
                                </svg>
                                Sân này thuộc cụm sân liên kết
                            </p>
                            <p class="mt-1 text-sm text-yellow-700">
                                Nếu một sân trong cụm đã được đặt, các sân còn lại cùng khung giờ sẽ tự khóa.
                            </p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach ($linkedFields as $item)
                                    <a href="{{ route('san.show', $item->id) }}"
                                        class="rounded-full border border-yellow-300 bg-white px-3 py-1 text-sm text-yellow-700 hover:bg-amber-100">
                                        {{ $item->name }} - {{ $item->fieldType->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex gap-6 mt-4 text-gray-600 text-sm">
                        <span class="gap-2 flex bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 256 256">
                                <path fill="currentColor"
                                    d="M68 236a16 16 0 1 1-16-16a16 16 0 0 1 16 16m16-48a16 16 0 1 0 16 16a16 16 0 0 0-16-16m-64 0a16 16 0 1 0 16 16a16 16 0 0 0-16-16m32 0a16 16 0 1 0-16-16a16 16 0 0 0 16 16M256 40a12 12 0 0 1-12 12h-23l-25.81 25.79l-21.45 125.54a20 20 0 0 1-33.86 10.8l-98-98a20 20 0 0 1 10.84-33.88l125.5-21.44l29.29-29.3A12 12 0 0 1 216 28h28a12 12 0 0 1 12 12m-86.68 46.68l-105 17.94l87.07 87.07Z" />
                            </svg>
                            Phòng thay đồ
                        </span>
                        <span class="gap-2 flex bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M5 17a2 2 0 1 0 4 0a2 2 0 1 0-4 0m10 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                    <path d="M5 17H3v-6l2-5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0H9m-6-6h15m-6 0V6" />
                                </g>
                            </svg>
                            Bãi đỗ xe
                        </span>
                        <span class="gap-2 flex bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M9 20h6v2H9zm-.83-4.95c.41.62.62 1.36.72 1.95H8v2h8v-2h-.89c.11-.59.31-1.33.72-1.95c.36-.54.76-1.01 1.14-1.46c1-1.18 2.03-2.39 2.03-4.6c0-3.86-3.14-7-7-7s-7 3.14-7 7c0 2.21 1.03 3.42 2.02 4.58c.39.45.78.92 1.15 1.47ZM12 4c2.76 0 5 2.24 5 5c0 1.47-.62 2.2-1.55 3.3c-.4.47-.85 1-1.28 1.64c-.68 1.03-.97 2.23-1.09 3.06h-2.17c-.12-.83-.4-2.03-1.08-3.05c-.43-.65-.89-1.19-1.29-1.66C7.61 11.2 7 10.48 7 9c0-2.76 2.24-5 5-5" />
                            </svg>
                            Đèn chiếu sáng
                        </span>
                    </div>
                </div>

                <!-- Bảng giá -->
                <div class="bg-white rounded-xl border border-gray-100 shadow p-6">
                    <h1 class="mb-5 flex flex-wrap items-center justify-between gap-3 text-xl font-semibold text-gray-800">
                        Bảng giá - Chọn lịch đặt sân

                        <span class="rounded-full bg-green-50 px-3 py-1 text-sm font-medium text-green-600">
                            {{ \Carbon\Carbon::parse($date)->locale('vi')->translatedFormat('l') }}
                        </span>
                    </h1>

                    <!-- Form chọn ngày -->
                    <form method="GET" action="{{ route('san.show', $field->id) }}" class="mb-6">
                        <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 shadow-sm transition focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-400"
                            min="{{ date('Y-m-d') }}">
                    </form>

                    @if ($morning->isEmpty() && $afternoon->isEmpty() && $evening->isEmpty())
                        <p class="rounded-lg bg-gray-50 px-4 py-3 font-semibold italic text-gray-500">
                            Đang cập nhật...
                        </p>
                    @endif

                    <!-- ===== SÁNG ===== -->
                    @if ($morning->count())
                        <span class="mt-5 mb-3 flex items-center gap-2 font-semibold uppercase tracking-wide text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 48 48">
                                <path fill="currentColor" stroke="currentColor" stroke-width="4"
                                    d="M24 33a9 9 0 1 0 0-18a9 9 0 0 0 0 18Z" />
                            </svg>
                            <span class="text-sm text-gray-500">Buổi sáng</span>
                        </span>

                        <div class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($morning as $price)
                                @php
                                    $isBooked = in_array($price->time_id, $bookedSlots);
                                    $timeLabel =
                                        \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') .
                                        ' - ' .
                                        \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i');
                                @endphp

                                @if ($isBooked)
                                    <div
                                        class="rounded-xl border border-gray-200 bg-gray-200 px-4 py-3 text-sm shadow-sm cursor-not-allowed">
                                        <div class="flex items-center justify-between gap-4">
                                            <span class="font-medium text-gray-500">{{ $timeLabel }}</span>
                                            <span class="whitespace-nowrap font-semibold text-gray-400">
                                                {{ number_format($price->price, 0, ',', '.') }}đ
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span
                                                class="rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-500">
                                                Đã đặt
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <a href="#"
                                        class="time-slot block rounded-xl border border-green-200 text-green-600
                                        bg-green-50 px-4 py-3 text-sm transition hover:text-white hover:bg-green-600"
                                        data-time-id="{{ $price->time_id }}" data-time="{{ $timeLabel }}"
                                        data-price="{{ $price->price }}">

                                        <div class="flex items-center justify-between gap-4">
                                            <span class="font-medium">{{ $timeLabel }}</span>
                                            <span class="whitespace-nowrap font-semibold">
                                                {{ number_format($price->price, 0, ',', '.') }}đ
                                            </span>
                                        </div>

                                        <div class="mt-2">
                                            <span
                                                class="rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-700">
                                                Chưa đặt
                                            </span>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <!-- ===== CHIỀU ===== -->
                    @if ($afternoon->count())
                        <span class="mt-6 mb-3 flex items-center gap-2 font-semibold uppercase tracking-wide text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 48 48">
                                <path fill="currentColor" stroke="currentColor" stroke-width="4"
                                    d="M24 33a9 9 0 1 0 0-18a9 9 0 0 0 0 18Z" />
                            </svg>
                            <span class="text-sm text-gray-500">Buổi chiều</span>
                        </span>

                        <div class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($afternoon as $price)
                                @php
                                    $isBooked = in_array($price->time_id, $bookedSlots);
                                    $timeLabel =
                                        \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') .
                                        ' - ' .
                                        \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i');
                                @endphp

                                @if ($isBooked)
                                    <div
                                        class="rounded-xl border border-gray-200 bg-gray-200 px-4 py-3 text-sm shadow-sm cursor-not-allowed">
                                        <div class="flex items-center justify-between gap-4">
                                            <span class="font-medium text-gray-500">{{ $timeLabel }}</span>
                                            <span class="whitespace-nowrap font-semibold text-gray-400">
                                                {{ number_format($price->price, 0, ',', '.') }}đ
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span
                                                class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-gray-500">
                                                Đã đặt
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <a href="#"
                                        class="time-slot block rounded-xl border border-green-200 text-green-600
                                        bg-green-50 px-4 py-3 text-sm transition hover:text-white hover:bg-green-600"
                                        data-time-id="{{ $price->time_id }}" data-time="{{ $timeLabel }}"
                                        data-price="{{ $price->price }}">

                                        <div class="flex items-center justify-between gap-4">
                                            <span class="font-medium">{{ $timeLabel }}</span>
                                            <span class="whitespace-nowrap font-semibold">
                                                {{ number_format($price->price, 0, ',', '.') }}đ
                                            </span>
                                        </div>

                                        <div class="mt-2">
                                            <span
                                                class="rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-700">
                                                Chưa đặt
                                            </span>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <!-- ===== TỐI ===== -->
                    @if ($evening->count())
                        <span
                            class="mt-6 mb-3 flex items-center gap-2 font-semibold uppercase tracking-wide text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 48 48">
                                <path fill="currentColor" stroke="currentColor" stroke-width="4"
                                    d="M24 33a9 9 0 1 0 0-18a9 9 0 0 0 0 18Z" />
                            </svg>
                            <span class="text-sm text-gray-500">Buổi tối</span>
                        </span>

                        <div class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($evening as $price)
                                @php
                                    $isBooked = in_array($price->time_id, $bookedSlots);
                                    $timeLabel =
                                        \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') .
                                        ' - ' .
                                        \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i');
                                @endphp

                                @if ($isBooked)
                                    <div
                                        class="rounded-xl border border-gray-200 bg-gray-200 px-4 py-3 text-sm shadow-sm cursor-not-allowed">
                                        <div class="flex items-center justify-between gap-4">
                                            <span class="font-medium text-gray-500">{{ $timeLabel }}</span>
                                            <span class="whitespace-nowrap font-semibold text-gray-400">
                                                {{ number_format($price->price, 0, ',', '.') }}đ
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span
                                                class="rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-500">
                                                Đã đặt
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <a href="#"
                                        class="time-slot block rounded-xl border border-green-200 text-green-600
                                        bg-green-50 px-4 py-3 text-sm transition hover:text-white hover:bg-green-600"
                                        data-time-id="{{ $price->time_id }}" data-time="{{ $timeLabel }}"
                                        data-price="{{ $price->price }}">

                                        <div class="flex items-center justify-between gap-4">
                                            <span class="font-medium">{{ $timeLabel }}</span>
                                            <span class="whitespace-nowrap font-semibold">
                                                {{ number_format($price->price, 0, ',', '.') }}đ
                                            </span>
                                        </div>

                                        <div class="mt-2">
                                            <span
                                                class="rounded-full bg-green-200 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                Chưa đặt
                                            </span>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-span-12 lg:col-span-4">
                <form action="{{ route('booking.checkout') }}" method="GET"
                    class="bg-white rounded-xl shadow p-6 sticky top-24">
                    <input type="hidden" name="field_id" value="{{ $field->id }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="time_id" id="hiddenTimeId">
                    <input type="hidden" name="price" id="hiddenPrice">
                    <div class="text-2xl font-bold text-green-600">
                        <h1 class="text-2xl font-bold">
                            {{ $field->name }}
                        </h1>
                    </div>
                    <div class="mt-6 space-y-4">
                        <div>
                            <label class="flex items-center gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="0">
                                    <path fill="currentColor"
                                        d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                </svg>
                                Ngày đã chọn
                            </label>
                            <input type="text" value="{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                                readonly>
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path fill="currentColor"
                                        d="M11.5 3a9.5 9.5 0 0 1 9.5 9.5a9.5 9.5 0 0 1-9.5 9.5A9.5 9.5 0 0 1 2 12.5A9.5 9.5 0 0 1 11.5 3m0 1A8.5 8.5 0 0 0 3 12.5a8.5 8.5 0 0 0 8.5 8.5a8.5 8.5 0 0 0 8.5-8.5A8.5 8.5 0 0 0 11.5 4M11 7h1v5.42l4.7 2.71l-.5.87l-5.2-3z" />
                                </svg>
                                Khung giờ đã chọn
                            </label>
                            <input type="text" id="selectedTime" placeholder="Chưa chọn khung giờ nào"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                                readonly>
                            @error('time_id')
                                <p class="bg-red-50 border-l-4 border-red-400 p-3 mt-2 rounded text-sm text-red-700">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="border-t mt-6 pt-4">
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-lg">Tổng cộng</span>
                            <span id="totalPrice" class="font-bold text-2xl">0đ</span>
                        </div>
                        @guest
                            <a href="{{ route('customer.login') }}"
                                class="block w-full text-center bg-green-600 text-white py-3 rounded-lg mt-4 hover:bg-green-700">
                                Đặt sân ngay
                            </a>
                        @endguest
                        @auth
                            <button type="submit"
                                class="w-full font-medium bg-green-600 text-white py-3 rounded-lg mt-4 hover:bg-green-700">
                                Đặt sân ngay
                            </button>
                        @endauth
                    </div>
                </form>
            </div>
        </div>
    </div>
@vite('resources/js/checkout.js')
@endsection
