@extends('customers.layouts.app')

@section('content')
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
                @forelse ($facilities as $facility)
                    <div class="bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition duration-300 ease-in-out group">
                        <div class="overflow-hidden rounded-t-xl">
                            <a href="{{ route('san.show', $facility->representativeField->id) }}">
                                @if ($facility->representativeField->images->first())
                                    <img src="{{ asset('storage/' . $facility->representativeField->images->first()->name) }}"
                                        class="h-48 w-full object-cover transition duration-500 group-hover:scale-110">
                                @else
                                    <img src="{{ asset('images/banner-client-placeholder.jpg') }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                @endif
                            </a>
                        </div>

                        <div class="p-5">
                            <h3 class="font-semibold text-lg transition duration-300 group-hover:text-green-600">
                                <a href="{{ route('san.show', $facility->representativeField->id) }}">
                                    {{ $facility->name }}
                                </a>
                            </h3>

                            <div class="space-y-2 mt-2">
                                <div class="flex items-start gap-2 text-gray-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600 mt-0.5 shrink-0"
                                        viewBox="0 0 256 256" stroke="currentColor" stroke-width="3">
                                        <path fill="currentColor"
                                            d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                                    </svg>
                                    <span>{{ $facility->address }}</span>
                                </div>

                                <div class="flex items-start gap-2 text-gray-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600 mt-0.5 shrink-0" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M10 13H3a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1m-1 7H4v-5h5ZM21 2h-7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1m-1 7h-5V4h5Zm1 4h-7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1m-1 7h-5v-5h5ZM10 2H3a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1M9 9H4V4h5Z"/>
                                    </svg>
                                    <span>{{ $facility->fields->count() }} sân</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('san.show', $facility->representativeField->id) }}"
                                    class="text-center font-medium block w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                    Chọn sân & đặt lịch
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
