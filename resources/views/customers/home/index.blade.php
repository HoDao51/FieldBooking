@extends('customers.layouts.app')

@section('content')
    <section class="relative bg-cover bg-center"
        style="background-image: url('{{ asset('images/hinh-nen-san-bong-4k-4.jpg') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-green-700/70"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-32 text-white">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                Đặt sân bóng <br>
                <span class="text-green-400">nhanh chóng </span>
                <span>&</span>
                <span class="text-green-400"> dễ dàng</span>
            </h1>

            <p class="text-lg text-gray-200 mb-8 max-w-xl">
                Tìm sân, chọn giờ và thanh toán chỉ trong vài phút.
                Trải nghiệm đặt sân thông minh cùng SânBóngPro.
            </p>

            <!-- Search Box -->
            <form method="GET" action="{{ route('home.search') }}"
                class="bg-white text-gray-600 rounded-xl shadow-xl p-6 max-w-4xl">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="relative">
                        <!-- Tỉnh -->
                        <select name="province" id="province"
                            class="appearance-none text-[#4B5563] w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-600">
                            <option value="">Chọn tỉnh thành</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <!-- SVG GIỮ NGUYÊN -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4B5563]" viewBox="0 0 16 16">
                                <path fill="currentColor"
                                    d="M13.069 5.157L8.384 9.768a.546.546 0 0 1-.768 0L2.93 5.158a.55.55 0 0 0-.771 0a.53.53 0 0 0 0 .759l4.684 4.61a1.65 1.65 0 0 0 2.312 0l4.684-4.61a.53.53 0 0 0 0-.76a.55.55 0 0 0-.771 0" />
                            </svg>
                        </div>
                    </div>

                    <!-- Loại sân -->
                    <div class="relative">
                        <select name="type_id"
                            class="appearance-none text-[#4B5563] w-full border border-gray-300 rounded-md px-3 py-3 bg-white focus:outline-none focus:ring-1 focus:ring-green-400">
                            <option value="">Tất cả loại sân</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <!-- SVG GIỮ NGUYÊN -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4B5563]" viewBox="0 0 16 16">
                                <path fill="currentColor"
                                    d="M13.069 5.157L8.384 9.768a.546.546 0 0 1-.768 0L2.93 5.158a.55.55 0 0 0-.771 0a.53.53 0 0 0 0 .759l4.684 4.61a1.65 1.65 0 0 0 2.312 0l4.684-4.61a.53.53 0 0 0 0-.76a.55.55 0 0 0-.771 0" />
                            </svg>
                        </div>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="flex items-center justify-center gap-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold py-3">
                        <!-- SVG GIỮ NGUYÊN -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                            class="text-white">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="text-base">
                            Tìm sân ngay
                        </span>
                    </button>
                </div>
            </form>

            <!-- Stats -->
            <div class="flex gap-10 mt-12 text-white">
                <div class="pr-5 border-r border-white">
                    <h2 class="text-3xl font-bold">500+</h2>
                    <p class="text-gray-300">Sân bóng</p>
                </div>
                <div class="pr-5 border-r border-white">
                    <h2 class="text-3xl font-bold">10K+</h2>
                    <p class="text-gray-300">Lượt đặt</p>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">34</h2>
                    <p class="text-gray-300">Tỉnh thành</p>
                </div>
            </div>

        </div>
    </section>

    <!-- sân nối bật -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold">Sân nổi bật</h2>
                    <p class="text-gray-500">Những sân được đặt nhiều nhất tuần này</p>
                </div>
                <a href="{{ route('home.search') }}" class="text-green-600 font-semibold hover:underline">
                    Xem tất cả →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($fields as $field)
                    <div
                        class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 
                                transition duration-300 ease-in-out group">
                        <!-- Ảnh -->
                        <div class="overflow-hidden rounded-t-xl">
                            <a href="{{ route('san.show', $field->id) }}">
                                @if ($field->images->first())
                                    <img src="{{ asset('storage/' . $field->images->first()->name) }}"
                                        class="h-48 w-full object-cover transition duration-500 group-hover:scale-110">
                                @else
                                    <img src="{{ asset('images/banner-client-placeholder.jpg') }}"
                                        class="w-full h-full object-cover">
                                @endif
                            </a>
                        </div>

                        <div class="p-5">
                            <!-- Tên sân -->
                            <h3 class="font-semibold text-lg transition duration-300 group-hover:text-green-600">
                                <a href="{{ route('san.show', $field->id) }}">
                                    {{ $field->name }}
                                </a>
                            </h3>

                            <div class="space-y-2 mt-2">
                                <div class="flex items-start gap-2 text-gray-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600 mt-0.5 shrink-0"
                                        viewBox="0 0 256 256" stroke="currentColor" stroke-width="3">
                                        <path fill="currentColor"
                                            d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                                    </svg>
                                    <span>{{ $field->address }}</span>
                                </div>

                                <div class="flex items-start gap-2 text-gray-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600 mt-0.5 shrink-0"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="0">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5">
                                            <path
                                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M16 3.128a4 4 0 0 1 0 7.744M22 21v-2a4 4 0 0 0-3-3.87" />
                                            <circle cx="9" cy="7" r="4" />
                                        </g>
                                    </svg>
                                    <span>{{ $field->fieldType->name }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between mt-4">
                                <span class="text-yellow-500">
                                    ⭐⭐⭐⭐⭐
                                </span>
                                <a href="{{ route('san.show', $field->id) }}"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                    Đặt ngay
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-green-600 py-16 text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Sẵn sàng đặt sân ngay hôm nay?</h2>
        <p class="mb-6">Tham gia cộng đồng đam mê bóng đá lớn nhất Việt Nam.</p>
        <a href="#" class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
            Đăng ký miễn phí
        </a>
    </section>
    @vite('resources/js/province.js')
@endsection
