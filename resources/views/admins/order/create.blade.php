@extends('admins.layouts.app')

@section('content')
    <div class="pl-2" data-direct-booking-page>
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('donDatSan.index') }}" class="text-gray-600 transition hover:text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m12 19l-7-7l7-7m7 7H5" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Thêm đơn đặt sân</h1>
                    <p class="mt-1 text-gray-500">
                        Nhân viên hoặc quản trị viên tạo đơn trực tiếp cho khách hàng tại sân
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-10 grid grid-cols-12 gap-6">
            <div class="col-span-12 space-y-6 lg:col-span-7">
                <div class="rounded-xl bg-white p-6 shadow">
                    <h2 class="mb-4 text-lg font-semibold">Chọn sân và ngày</h2>

                    <form method="GET" action="{{ route('donDatSan.create') }}"
                        class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-600">Sân bóng</label>
                            <div class="relative">
                                <select name="field_id" onchange="this.form.submit()"
                                    class="w-full appearance-none rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                                    <option value="">-- Chọn sân --</option>
                                    @foreach ($fields as $field)
                                        <option value="{{ $field->id }}"
                                            @if ($selectedField && $selectedField->id == $field->id) selected @endif>
                                            {{ $field->name }} - {{ $field->fieldType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#4B5563]"
                                        viewBox="0 0 16 16">
                                        <path fill="currentColor"
                                            d="M13.069 5.157L8.384 9.768a.546.546 0 0 1-.768 0L2.93 5.158a.55.55 0 0 0-.771 0a.53.53 0 0 0 0 .759l4.684 4.61a1.65 1.65 0 0 0 2.312 0l4.684-4.61a.53.53 0 0 0 0-.76a.55.55 0 0 0-.771 0" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-600">Ngày đặt sân</label>
                            <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                                min="{{ date('Y-m-d') }}">
                        </div>
                    </form>
                </div>

                <form action="{{ route('donDatSan.storeAtField') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="field_id"
                        value="@if (old('field_id')){{ old('field_id') }}@elseif ($selectedField){{ $selectedField->id }}@endif">
                    <input type="hidden" name="date" value="{{ old('date', $date) }}">
                    <input type="hidden" name="time_id" id="hiddenTimeId" value="{{ old('time_id') }}">
                    <input type="hidden" name="price" id="hiddenPrice" value="{{ old('price') }}">

                    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow">
                        <h1 class="mb-5 flex flex-wrap items-center justify-between gap-3 text-xl font-semibold text-gray-800">
                            Bảng giá - Chọn lịch đặt sân

                            <span class="rounded-full bg-green-50 px-3 py-1 text-sm font-medium text-green-600">
                                {{ \Carbon\Carbon::parse($date)->locale('vi')->translatedFormat('l') }}
                            </span>
                        </h1>

                        @if (!$selectedField)
                            <p class="rounded-lg bg-gray-50 px-4 py-3 font-semibold italic text-gray-500">
                                Chọn sân và ngày ở phía trên để xem khung giờ khả dụng.
                            </p>
                        @else
                            @if ($morning->isEmpty() && $afternoon->isEmpty() && $evening->isEmpty())
                                <p class="rounded-lg bg-gray-50 px-4 py-3 font-semibold italic text-gray-500">
                                    Đang cập nhật...
                                </p>
                            @endif

                            @if ($morning->count())
                                <span class="mt-5 mb-3 flex items-center gap-2 font-semibold uppercase tracking-wide text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500"
                                        viewBox="0 0 48 48">
                                        <path fill="currentColor" stroke="currentColor" stroke-width="4"
                                            d="M24 33a9 9 0 1 0 0-18a9 9 0 0 0 0 18Z" />
                                    </svg>
                                    <span class="text-sm text-gray-500">Buổi sáng</span>
                                </span>

                                <div class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-3">
                                    @foreach ($morning as $price)
                                        @if (in_array($price->time_id, $bookedSlots))
                                            <div class="cursor-not-allowed rounded-xl border border-gray-200 bg-gray-200 px-4 py-3 text-sm shadow-sm">
                                                <div class="flex items-center justify-between gap-4">
                                                    <span class="font-medium text-gray-500">
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}
                                                    </span>
                                                    <span class="font-semibold text-gray-400">{{ number_format($price->price, 0, ',', '.') }}đ</span>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-500">
                                                        Đã đặt
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <a href="#"
                                                class="time-slot block rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-600 transition hover:bg-green-600 hover:text-white"
                                                data-time-id="{{ $price->time_id }}"
                                                data-time="{{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }} - {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}"
                                                data-price="{{ $price->price }}">
                                                <div class="flex items-center justify-between gap-4">
                                                    <span class="font-medium">
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}
                                                    </span>
                                                    <span class="font-semibold">{{ number_format($price->price, 0, ',', '.') }}đ</span>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-700">
                                                        Còn trống
                                                    </span>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            @if ($afternoon->count())
                                <span class="mt-6 mb-3 flex items-center gap-2 font-semibold uppercase tracking-wide text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500"
                                        viewBox="0 0 48 48">
                                        <path fill="currentColor" stroke="currentColor" stroke-width="4"
                                            d="M24 33a9 9 0 1 0 0-18a9 9 0 0 0 0 18Z" />
                                    </svg>
                                    <span class="text-sm text-gray-500">Buổi chiều</span>
                                </span>

                                <div class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-3">
                                    @foreach ($afternoon as $price)
                                        @if (in_array($price->time_id, $bookedSlots))
                                            <div class="cursor-not-allowed rounded-xl border border-gray-200 bg-gray-200 px-4 py-3 text-sm shadow-sm">
                                                <div class="flex items-center justify-between gap-4">
                                                    <span class="font-medium text-gray-500">
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}
                                                    </span>
                                                    <span class="font-semibold text-gray-400">{{ number_format($price->price, 0, ',', '.') }}đ</span>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-gray-500">
                                                        Đã đặt
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <a href="#"
                                                class="time-slot block rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-600 transition hover:bg-green-600 hover:text-white"
                                                data-time-id="{{ $price->time_id }}"
                                                data-time="{{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }} - {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}"
                                                data-price="{{ $price->price }}">
                                                <div class="flex items-center justify-between gap-4">
                                                    <span class="font-medium">
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}
                                                    </span>
                                                    <span class="font-semibold">{{ number_format($price->price, 0, ',', '.') }}đ</span>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-700">
                                                        Còn trống
                                                    </span>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            @if ($evening->count())
                                <span class="mt-6 mb-3 flex items-center gap-2 font-semibold uppercase tracking-wide text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                        viewBox="0 0 48 48">
                                        <path fill="currentColor" stroke="currentColor" stroke-width="4"
                                            d="M24 33a9 9 0 1 0 0-18a9 9 0 0 0 0 18Z" />
                                    </svg>
                                    <span class="text-sm text-gray-500">Buổi tối</span>
                                </span>

                                <div class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-3">
                                    @foreach ($evening as $price)
                                        @if (in_array($price->time_id, $bookedSlots))
                                            <div class="cursor-not-allowed rounded-xl border border-gray-200 bg-gray-200 px-4 py-3 text-sm shadow-sm">
                                                <div class="flex items-center justify-between gap-4">
                                                    <span class="font-medium text-gray-500">
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}
                                                    </span>
                                                    <span class="font-semibold text-gray-400">{{ number_format($price->price, 0, ',', '.') }}đ</span>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-500">
                                                        Đã đặt
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <a href="#"
                                                class="time-slot block rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-600 transition hover:bg-green-600 hover:text-white"
                                                data-time-id="{{ $price->time_id }}"
                                                data-time="{{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }} - {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}"
                                                data-price="{{ $price->price }}">
                                                <div class="flex items-center justify-between gap-4">
                                                    <span class="font-medium">
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->startTime)->format('H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($price->TimeSlot->endTime)->format('H:i') }}
                                                    </span>
                                                    <span class="font-semibold">{{ number_format($price->price, 0, ',', '.') }}đ</span>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="rounded-full bg-green-200 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                        Còn trống
                                                    </span>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            @error('time_id')
                                <p class="mt-3 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div class="rounded-xl bg-white p-6 shadow">
                        <h2 class="mb-4 text-lg font-semibold">Thông tin khách hàng</h2>

                        <div class="space-y-4">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-600">Loại khách hàng</label>
                                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                    <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-4 text-sm">
                                        <input type="radio" name="customer_type" value="existing"
                                            @if (old('customer_type', 'existing') == 'existing') checked @endif class="customer-type mt-1">
                                        <div>
                                            <p class="font-semibold">Khách hàng đã có tài khoản</p>
                                        </div>
                                    </label>

                                    <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-4 text-sm">
                                        <input type="radio" name="customer_type" value="guest"
                                            @if (old('customer_type') == 'guest') checked @endif class="customer-type mt-1">
                                        <div>
                                            <p class="font-semibold">Khách hàng chưa có tài khoản</p>
                                        </div>
                                    </label>
                                </div>
                                @error('customer_type')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="existingCustomerSection" class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                                <label class="mb-2 block text-sm font-medium text-gray-600">Chọn khách hàng</label>
                                <div class="relative">
                                    <select name="customer_id" id="customerSelect"
                                        class="w-full appearance-none rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                                        <option value="">-- Chọn khách hàng --</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" data-name="{{ $customer->name }}"
                                                data-phone="{{ $customer->phoneNumber }}"
                                                data-email="{{ $customer->email }}"
                                                @if (old('customer_id') == $customer->id) selected @endif>
                                                {{ $customer->name }} - {{ $customer->phoneNumber }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#4B5563]"
                                            viewBox="0 0 16 16">
                                            <path fill="currentColor"
                                                d="M13.069 5.157L8.384 9.768a.546.546 0 0 1-.768 0L2.93 5.158a.55.55 0 0 0-.771 0a.53.53 0 0 0 0 .759l4.684 4.61a1.65 1.65 0 0 0 2.312 0l4.684-4.61a.53.53 0 0 0 0-.76a.55.55 0 0 0-.771 0" />
                                        </svg>
                                    </div>
                                </div>
                                @error('customer_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="guestCustomerSection" class="rounded-xl border border-gray-200 bg-white p-4">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-gray-600">Họ và tên</label>
                                    <input type="text" name="contactName" id="contactName"
                                        value="{{ old('contactName') }}"
                                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                                    @error('contactName')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-gray-600">Số điện thoại</label>
                                        <input type="text" name="contactPhone" id="contactPhone"
                                            value="{{ old('contactPhone') }}"
                                            class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                                        @error('contactPhone')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-gray-600">Email</label>
                                        <input type="email" name="contactEmail" id="contactEmail"
                                            value="{{ old('contactEmail') }}"
                                            class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                                        @error('contactEmail')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl bg-white p-6 shadow">
                        <h2 class="mb-4 text-lg font-semibold">Thanh toán</h2>

                        <div class="space-y-4">
                            <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3">
                                <p class="font-semibold text-green-700">Hình thức thanh toán: Thanh toán toàn bộ</p>
                                <p class="mt-1 text-sm text-green-700">Đơn đặt trực tiếp tại sân không áp dụng đặt cọc.</p>
                            </div>

                            <div>
                                <label class="mb-2 block text-lg font-medium text-gray-600">Phương thức thanh toán</label>
                                @foreach ($payments as $payment)
                                    <div class="mt-2 flex items-center">
                                        <input type="radio" id="payment{{ $payment->id }}" name="payment_id"
                                            value="{{ $payment->id }}" @if (old('payment_id') == $payment->id) checked @endif
                                            required class="mr-2">
                                        <label for="payment{{ $payment->id }}">{{ $payment->name }}</label>
                                    </div>
                                @endforeach
                                @error('payment_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-span-12 lg:col-span-5">
                <div class="sticky top-24 rounded-xl bg-white p-6 shadow">
                    <h2 class="mb-4 text-lg font-semibold">Tóm tắt đơn đặt sân</h2>

                    <div class="flex items-center gap-3">
                        @if ($selectedField && $selectedField->images->count() > 0)
                            <img src="{{ asset('storage/' . $selectedField->images->first()->name) }}"
                                class="h-12 w-12 rounded-lg object-cover">
                        @else
                            <img src="{{ asset('images/banner-client-placeholder.jpg') }}"
                                class="h-12 w-12 rounded-lg object-cover">
                        @endif

                        <div>
                            <p class="font-semibold text-gray-800">
                                @if ($selectedField)
                                    {{ $selectedField->name }}
                                @else
                                    Chưa chọn sân
                                @endif
                            </p>
                            <p class="text-sm text-gray-500">
                                @if ($selectedField)
                                    {{ $selectedField->fieldType->name }}
                                @else
                                    Chưa có loại sân
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between gap-3 border-b pb-4">
                        <span class="font-medium text-gray-700" id="summaryTime">Chưa chọn khung giờ</span>
                        <span class="font-medium text-gray-800" id="summaryPriceTop">0đ</span>
                    </div>

                    <div class="space-y-3 py-4 text-sm">
                        <div class="flex items-center justify-between gap-3">
                            <span>Tạm tính</span>
                            <span id="summaryPrice">0đ</span>
                        </div>

                        <div class="flex justify-between gap-3 text-green-600">
                            <span>Phí dịch vụ</span>
                            <span>Miễn phí</span>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <span>Hình thức</span>
                            <span>Thanh toán toàn bộ</span>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <span class="font-semibold text-gray-800">Cần thanh toán ngay</span>
                            <span class="font-semibold text-gray-800" id="summaryPayNow">0đ</span>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-semibold text-gray-800">Tổng cộng</span>
                            <span class="text-2xl font-bold text-green-600" id="summaryTotal">0đ</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="mt-4 w-full rounded-lg bg-green-600 py-3 font-medium text-white transition hover:bg-green-700">
                        Xác nhận thông tin
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
