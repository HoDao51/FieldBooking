@extends('customers.layouts.app')

@section('content')
    <!-- sân nối bật -->
    <section class="py-5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                @if ($search)
                    <h2 class="text-2xl font-bold">
                        Kết quả tìm kiếm: "{{ $search }}"
                    </h2>
                @else
                    <h2 class="text-2xl font-bold">
                        Tất cả sân bóng đang hoạt động
                    </h2>
                @endif
            </div>

            <div class="mb-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($fields as $field)
                    <div
                        class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 
                                transition duration-300 ease-in-out group">
                        <!-- Ảnh -->
                        <div class="overflow-hidden rounded-t-xl">
                            <a href="{{ route('san.show', $field->id) }}">
                                <img src="{{ asset('storage/' . $field->images->first()->name) }}"
                                    class="h-48 w-full object-cover transition duration-500 group-hover:scale-110">
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
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-32">
                        Không tìm thấy sân phù hợp
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
