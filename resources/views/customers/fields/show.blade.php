@extends('customers.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="grid grid-cols-12 gap-6">

        <!-- LEFT -->
        <div class="col-span-12 lg:col-span-8 space-y-6">

            <!-- Gallery -->
            <div class="bg-white rounded-xl shadow p-3">
                <div class="grid grid-cols-3 gap-3">

                    @foreach($field->images as $image)
                        <img 
                        src="{{ asset('storage/'.$image->name) }}"
                        class="h-48 w-full object-cover rounded-lg hover:scale-105 transition">
                    @endforeach

                </div>
            </div>


            <!-- Thông tin sân -->
            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex justify-between items-center">

                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ $field->name }}
                        </h1>

                        <p class="text-gray-500 mt-1">
                            ⭐ 5 (36 đánh giá) • {{ $field->address }}
                        </p>
                    </div>

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                        {{ $field->fieldType->name }}
                    </span>

                </div>

                <div class="flex gap-6 mt-4 text-gray-600 text-sm">
                    <span class="gap-2 flex bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 256 256">
                            <path fill="currentColor" d="M68 236a16 16 0 1 1-16-16a16 16 0 0 1 16 16m16-48a16 16 0 1 0 16 16a16 16 0 0 0-16-16m-64 0a16 16 0 1 0 16 16a16 16 0 0 0-16-16m32 0a16 16 0 1 0-16-16a16 16 0 0 0 16 16M256 40a12 12 0 0 1-12 12h-23l-25.81 25.79l-21.45 125.54a20 20 0 0 1-33.86 10.8l-98-98a20 20 0 0 1 10.84-33.88l125.5-21.44l29.29-29.3A12 12 0 0 1 216 28h28a12 12 0 0 1 12 12m-86.68 46.68l-105 17.94l87.07 87.07Z"/>
                        </svg>
                        Phòng thay đồ
                    </span>
                    <span class="gap-2 flex bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M5 17a2 2 0 1 0 4 0a2 2 0 1 0-4 0m10 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0"/>
                                <path d="M5 17H3v-6l2-5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0H9m-6-6h15m-6 0V6"/>
                            </g>
                        </svg>
                        Bãi đỗ xe
                    </span>
                    <span class="gap-2 flex bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M9 20h6v2H9zm-.83-4.95c.41.62.62 1.36.72 1.95H8v2h8v-2h-.89c.11-.59.31-1.33.72-1.95c.36-.54.76-1.01 1.14-1.46c1-1.18 2.03-2.39 2.03-4.6c0-3.86-3.14-7-7-7s-7 3.14-7 7c0 2.21 1.03 3.42 2.02 4.58c.39.45.78.92 1.15 1.47ZM12 4c2.76 0 5 2.24 5 5c0 1.47-.62 2.2-1.55 3.3c-.4.47-.85 1-1.28 1.64c-.68 1.03-.97 2.23-1.09 3.06h-2.17c-.12-.83-.4-2.03-1.08-3.05c-.43-.65-.89-1.19-1.29-1.66C7.61 11.2 7 10.48 7 9c0-2.76 2.24-5 5-5"/>
                        </svg>
                        Đèn chiếu sáng
                    </span>

                </div>

            </div>

            <!-- Bảng giá -->
            <div class="bg-white rounded-xl shadow p-6">

                <h2 class="font-semibold text-lg mb-4">
                    Bảng giá
                </h2>

                <div class="grid grid-cols-3 gap-2">
                    @foreach($prices as $price)
                    <div class="mr-3 flex items-center justify-between gap-3 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                        <!-- Left -->
                        <div class="flex items-center gap-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M11.5 3a9.5 9.5 0 0 1 9.5 9.5a9.5 9.5 0 0 1-9.5 9.5A9.5 9.5 0 0 1 2 12.5A9.5 9.5 0 0 1 11.5 3m0 1A8.5 8.5 0 0 0 3 12.5a8.5 8.5 0 0 0 8.5 8.5a8.5 8.5 0 0 0 8.5-8.5A8.5 8.5 0 0 0 11.5 4M11 7h1v5.42l4.7 2.71l-.5.87l-5.2-3z" />
                                </svg>
                            </span>

                            <span class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }}
                                - 
                                {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}
                            </span>
                        </div>

                        <!-- right -->
                        <span class="text-green-600 font-semibold">
                            {{ number_format($price->price,0,',','.') }}đ
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Chọn lịch -->
        <div class="bg-white rounded-xl shadow p-6">

            <h2 class="font-semibold text-lg mb-4">
                Chọn lịch đặt sân
            </h2>

            <!-- Chọn ngày -->
            <form method="GET" action="{{ route('san.show', $field->id) }}">
                <input 
                    type="date"
                    name="date"
                    value="{{ $date }}"
                    onchange="this.form.submit()"
                    class="border rounded-lg p-3 w-full mb-6">
            </form>

            <!-- Ngày đang chọn -->
            <p class="text-sm text-gray-500 mb-3">
                Khung giờ khả dụng
            </p>
            @php
                \Carbon\Carbon::setLocale('vi');
            @endphp

            <p class="text-sm text-gray-500 mb-3">
                Khung giờ khả dụng - 
                {{ \Carbon\Carbon::parse($date)->translatedFormat('l d/m') }}
            </p>

        </div>

    </div>


        <!-- RIGHT -->
        <div class="col-span-12 lg:col-span-4">

            <div class="bg-white rounded-xl shadow p-6 sticky top-24">

                <div class="text-2xl font-bold text-green-600">
                    200.000đ
                    <span class="text-gray-500 text-sm">/giờ</span>
                </div>

                <div class="mt-6 space-y-4">

                    <div>
                        <label class="text-sm text-gray-500">
                            Ngày đã chọn
                        </label>

                        <input 
                        type="date"
                        class="border rounded-lg w-full p-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">
                            Khung giờ
                        </label>

                        <select class="border rounded-lg w-full p-2 mt-1">
                            <option>Chọn giờ</option>
                            <option>06:00 - 08:00</option>
                            <option>08:00 - 10:00</option>
                            <option>10:00 - 12:00</option>
                        </select>
                    </div>

                </div>

                <div class="border-t mt-6 pt-4">

                    <div class="flex justify-between font-semibold">
                        <span>Tổng cộng</span>
                        <span>200.000đ</span>
                    </div>

                    <button class="w-full bg-green-600 text-white py-3 rounded-lg mt-4 hover:bg-green-700">
                        Đặt sân ngay
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection