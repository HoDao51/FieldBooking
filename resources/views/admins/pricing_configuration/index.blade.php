@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600 scale-125" viewBox="0 0 56 56"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M29 30v10c3.519-.316 5-2.287 5-4.89c0-2.507-1.152-3.99-5-5.11m-3-5v-9c-3.273.415-5 2.33-5 4.43s1.364 3.647 5 4.57m2.84.737l1.072.277C35.784 27.423 39 29.917 39 34.836c0 5.658-4.466 8.868-10.16 9.284V48h-2.523v-3.88c-5.672-.439-10.16-3.741-10.317-9.284h4.622c.402 2.702 2.1 4.688 5.695 5.08V29.849l-.916-.231c-5.672-1.363-8.731-3.996-8.731-8.684c0-5.173 4.02-8.591 9.647-9.03V8h2.523v3.903c5.582.462 9.624 3.926 9.803 9.169h-4.645c-.29-2.91-2.3-4.596-5.158-4.966z" />
                </svg>

                <span>Cấu hình giá giờ</span>
            </h1>

            <p class="text-gray-500 mt-1">
                Chọn sân bóng để cấu hình bảng giá theo khung giờ
            </p>
        </div>

        {{-- SEARCH --}}
        <div class="flex justify-between items-center mb-4">
            <!-- Search -->
            <form method="GET" action="{{ route('cauHinhGiaGio.index') }}" class="flex items-center space-x-2 mb-2">
                <!-- Thanh tìm kiếm -->
                <div class="relative w-[400px] rounded border border-gray-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Tìm kiếm sân..."
                        class="bg-[#F2F2F2] pl-10 pr-3 py-2 rounded w-full d-lg focus:ring-2 focus:ring-green-400 outline-none">
                </div>
                <!-- Nút tìm kiếm -->
                <button type="submit" class="bg-[#D9D9D9] text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    Tìm kiếm
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($fields as $item)
                <a href="{{ route('cauHinhGiaGio.show', $item->id) }}"
                    class="bg-white rounded-xl border shadow-sm hover:shadow-md hover:border-green-400 transition p-4 flex gap-4">

                    {{-- ẢNH --}}
                    <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                        @if ($item->images->first())
                            <img src="{{ asset('storage/' . $item->images->first()->name) }}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/sbcf-default-avatar.png') }}" class="w-full h-full object-cover">
                        @endif
                    </div>

                    {{-- THÔNG TIN --}}
                    <div class="flex flex-col justify-center">

                        <h3 class="font-semibold text-gray-800 text-lg">
                            {{ $item->name }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $item->address }}
                        </p>

                        <div class="mt-1 flex items-center gap-2 text-sm">

                            {{-- Loại sân --}}
                            <span class="px-2 py-0.5 text-xs rounded-full bg-gray-100 text-gray-600">
                                {{ $item->fieldType->name ?? '' }}
                            </span>
                        </div>

                    </div>
                </a>

            @empty
                <div class="col-span-3 text-center py-10 text-gray-500">
                    Không có sân nào
                </div>
            @endforelse

        </div>

        @if ($fields->hasPages())
            <div class="flex justify-center items-center gap-2 mt-6">
                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $fields->lastPage(); $i++)
                    @if ($i == $fields->currentPage())
                        <span class="px-4 py-2 bg-green-600 text-white rounded">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $fields->url($i) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            </div>
        @endif

    </div>
@endsection
