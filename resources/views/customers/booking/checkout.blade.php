@extends('customers.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8" data-checkout-page data-full-price="{{ $price }}"
        data-deposit-price="{{ $depositPrice }}">
        <div class="mb-3 flex items-center">
            <a href="{{ route('san.show', $field->id) }}"
                class="flex items-center gap-2 text-gray-500 transition hover:text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m12 19l-7-7l7-7m7 7H5" />
                </svg>
                <p class="text-gray-500 hover:text-green-600">Quay lại</p>
            </a>
        </div>

        <h1 class="mb-6 text-2xl font-bold">Xác nhận thông tin đặt sân</h1>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 space-y-6 lg:col-span-8">
                <div class="rounded-xl bg-white p-6 shadow">
                    <h2 class="mb-4 font-semibold">Thông tin đặt sân</h2>

                    <div class="flex gap-4">
                        @if ($field->images->first())
                            <img src="{{ asset('storage/' . $field->images->first()->name) }}"
                                class="h-20 w-28 rounded-lg object-cover">
                        @else
                            <img src="{{ asset('images/banner-client-placeholder.jpg') }}"
                                class="h-20 w-28 rounded-lg object-cover">
                        @endif

                        <div>
                            <h3 class="font-semibold">{{ $field->name }}</h3>

                            <div class="mb-2 flex items-center gap-2 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" viewBox="0 0 256 256"
                                    stroke="currentColor" stroke-width="3">
                                    <path fill="currentColor"
                                        d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                                </svg>
                                <span>{{ $field->address }}</span>
                            </div>

                            <p class="flex items-center gap-2 text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="0">
                                    <path fill="currentColor"
                                        d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($date)->locale('vi')->translatedFormat('l, d/m/Y') }}</span>
                            </p>

                            <p
                                class="mt-2 flex w-fit items-center gap-2 rounded-full bg-green-100 px-3 py-1 text-sm text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="0.5">
                                    <path fill="currentColor"
                                        d="M11.5 3a9.5 9.5 0 0 1 9.5 9.5a9.5 9.5 0 0 1-9.5 9.5A9.5 9.5 0 0 1 2 12.5A9.5 9.5 0 0 1 11.5 3m0 1A8.5 8.5 0 0 0 3 12.5a8.5 8.5 0 0 0 8.5 8.5a8.5 8.5 0 0 0 8.5-8.5A8.5 8.5 0 0 0 11.5 4M11 7h1v5.42l4.7 2.71l-.5.87l-5.2-3z" />
                                </svg>
                                <span>{{ $time }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="field_id" value="{{ $field->id }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="time_id" value="{{ $time_id }}">
                    <input type="hidden" name="price" value="{{ $price }}">

                    <div class="rounded-xl bg-white p-6 shadow">
                        <h2 class="mb-4 text-xl font-bold">Thông tin người đặt</h2>

                        <div class="space-y-4">
                            <div>
                                <label class="flex items-center gap-2 text-base font-semibold text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    Họ và tên
                                </label>
                                <input type="text" name="contactName" placeholder="Nhập họ và tên"
                                    value="{{ auth()->user()->name }}"
                                    class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2.5 focus:outline-none focus:ring-1 focus:ring-green-400">
                                @error('contactName')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="flex items-center gap-2 text-base font-semibold text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="0.5">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M5.733 2.043c1.217-1.21 3.221-.995 4.24.367l1.262 1.684c.83 1.108.756 2.656-.229 3.635l-.238.238a.65.65 0 0 0-.008.306c.063.408.404 1.272 1.832 2.692s2.298 1.76 2.712 1.824a.7.7 0 0 0 .315-.009l.408-.406c.876-.87 2.22-1.033 3.304-.444l1.91 1.04c1.637.888 2.05 3.112.71 4.445l-1.421 1.412c-.448.445-1.05.816-1.784.885c-1.81.169-6.027-.047-10.46-4.454c-4.137-4.114-4.931-7.702-5.032-9.47l.749-.042l-.749.042c-.05-.894.372-1.65.91-2.184zm3.04 1.266c-.507-.677-1.451-.731-1.983-.202l-1.57 1.56c-.33.328-.488.69-.468 1.036c.08 1.405.72 4.642 4.592 8.492c4.062 4.038 7.813 4.159 9.263 4.023c.296-.027.59-.181.865-.454l1.42-1.413c.578-.574.451-1.62-.367-2.064l-1.91-1.039c-.528-.286-1.146-.192-1.53.19l-.455.453l-.53-.532c.53.532.529.533.528.533l-.001.002l-.003.003l-.007.006l-.015.014a1 1 0 0 1-.136.106c-.08.053-.186.112-.319.161c-.27.101-.628.155-1.07.087c-.867-.133-2.016-.724-3.543-2.242c-1.526-1.518-2.122-2.66-2.256-3.526c-.069-.442-.014-.8.088-1.07a1.5 1.5 0 0 1 .238-.42l.032-.035l.014-.015l.006-.006l.003-.003l.002-.002l.53.53l-.53-.531l.288-.285c.428-.427.488-1.134.085-1.673z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Số điện thoại
                                </label>
                                <input type="text" name="contactPhone" placeholder="Nhập số điện thoại"
                                    value="{{ auth()->user()->customers->phoneNumber }}"
                                    class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2.5 focus:outline-none focus:ring-1 focus:ring-green-400">
                                @error('contactPhone')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="flex items-center gap-2 text-base font-semibold text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="0.5">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="m4.2 5.2l7.56 5.67a.4.4 0 0 0 .48 0L19.8 5.2zm16.6.75l-7.84 5.88a1.6 1.6 0 0 1-1.92 0L3.2 5.95V18.8h17.6zM3 4h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1" />
                                    </svg>
                                    Email
                                </label>
                                <input type="email" name="contactEmail" placeholder="Nhập email"
                                    value="{{ auth()->user()->email }}"
                                    class="w-full mt-1 rounded-md border border-gray-300 px-3 py-2.5 focus:outline-none focus:ring-1 focus:ring-green-400">
                                @error('contactEmail')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl bg-white p-6 shadow">
                        <h2 class="mb-4 text-xl font-bold">Hình thức thanh toán</h2>
                        <div class="space-y-3">
                            <label class="payment-item flex items-center gap-3 rounded-lg border border-gray-200 p-4 cursor-pointer transition">
                                <input type="radio" name="payment_type" value="0" class="accent-green-600"
                                    @if (old('payment_type')) checked @endif required>
                                <div>
                                    <p class="font-semibold">Thanh toán toàn bộ</p>
                                    <p class="text-sm text-gray-500">
                                        Chuyển khoản toàn bộ giá trị đơn đặt sân.
                                    </p>
                                </div>
                            </label>
                            <label class="payment-item flex items-center gap-3 rounded-lg border border-gray-200 p-4 cursor-pointer transition">
                                <input type="radio" name="payment_type" value="1" class="accent-green-600"
                                    @if (old('payment_type')) checked @endif required>
                                <div>
                                    <p class="font-semibold">Đặt cọc 50%</p>
                                    <p class="text-sm text-gray-500">
                                        Thanh toán trước 50%, phần còn lại thanh toán bằng tiền mặt tại sân.
                                    </p>
                                </div>
                            </label>
                        </div>

                        @error('payment_type')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                        <div class="mt-6">
                            <h2 class="mb-4 text-xl font-bold">Phương thức thanh toán</h2>

                            @foreach ($payments as $payment)
                                <div class="mt-2 flex items-center">
                                    <label class="payment-item flex items-center gap-4 p-4 border rounded-xl border-gray-200 w-full cursor-pointer transition">
                                        <input type="radio" name="payment_id" value="{{ $payment->id }}"
                                            class="accent-green-600" @if (old('payment_id') == $payment->id) checked @endif
                                            required>

                                        <div class="font-semibold">
                                            {{ $payment->name }}
                                        </div>

                                        <!-- Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon w-5 h-5 ml-auto text-green-600 opacity-0 transition"
                                            viewBox="0 0 16 16">
                                            <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5">
                                                <path
                                                    d="m14.25 8.75c-.5 2.5-2.3849 4.85363-5.03069 5.37991-2.64578.5263-5.33066-.7044-6.65903-3.0523-1.32837-2.34784-1.00043-5.28307.81336-7.27989 1.81379-1.99683 4.87636-2.54771 7.37636-1.54771" />
                                                <polyline points="5.75 7.75 8.25 10.25 14.25 3.75" />
                                            </g>
                                        </svg>
                                    </label>
                                </div>
                            @endforeach

                            @error('payment_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <div class="sticky top-24 rounded-xl bg-white p-6 shadow">
                    <h3 class="mb-4 font-semibold">Tóm tắt đơn đặt sân</h3>

                    <div class="mb-4 flex items-center gap-3">
                        @if ($field->images->first())
                            <img src="{{ asset('storage/' . $field->images->first()->name) }}"
                                class="h-12 w-12 rounded-lg object-cover">
                        @else
                            <img src="{{ asset('images/banner-client-placeholder.jpg') }}"
                                class="h-12 w-12 rounded-lg object-cover">
                        @endif

                        <div>
                            <p class="text-sm font-semibold">{{ $field->name }}</p>
                            <p class="text-xs text-gray-500">{{ $field->fieldType->name }}</p>
                        </div>
                    </div>

                    <div class="mb-3 flex justify-between text-sm">
                        <span>{{ $time }}</span>
                        <span>{{ number_format($price, 0, ',', '.') }}đ</span>
                    </div>

                    @error('time_id')
                        <div class="mt-2 rounded border-l-4 border-red-400 bg-red-50 p-3 text-sm text-red-700">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="space-y-2 border-t pt-4 text-sm">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span>{{ number_format($price, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Phí dịch vụ</span>
                            <span>Miễn phí</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Hình thức</span>
                            <span id="paymentTypeLabel">Thanh toán toàn bộ</span>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <span>Cần thanh toán ngay</span>
                            <span class="payNowAmount">{{ number_format($price, 0, ',', '.') }}đ</span>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-between border-t pt-4 font-semibold">
                        <span class="text-lg">Tổng cộng</span>
                        <span class="payNowAmount text-2xl font-bold text-green-600">
                            {{ number_format($price, 0, ',', '.') }}đ
                        </span>
                    </div>

                    <button type="submit"
                        class="mt-4 w-full rounded-lg bg-green-600 py-3 font-medium text-white transition hover:bg-green-700">
                        Xác nhận thông tin
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection