@extends('admins.layouts.app')

@section('content')
    <div class="pl-2" @if (session('modal') === 'edit') data-auto-open-modal="conflictModal" @endif>
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-dasharray="28" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2"
                        d="M13 6l2 -2c1 -1 3 -1 4 0l1 1c1 1 1 3 0 4l-5 5c-1 1 -3 1 -4 0M11 18l-2 2c-1 1 -3 1 -4 0l-1 -1c-1 -1 -1 -3 0 -4l5 -5c1 -1 3 -1 4 0" />
                </svg>
                <span>Thiết lập sân liên kết</span>
            </h1>
            <p class="text-gray-500 mt-1">
                Cấu hình các sân thành 1 cụm sân sẽ khóa cùng khung giờ với nhau
            </p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <form method="GET" action="{{ route('sanLienKet.index') }}" class="flex items-center space-x-2">
                <div class="relative w-[400px] rounded border border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Tìm theo tên sân hoặc địa chỉ"
                        class="bg-[#F2F2F2] pl-10 pr-3 py-2 rounded w-full focus:ring-2 focus:ring-green-400 outline-none">
                </div>
                <button type="submit"
                    class="bg-[#D9D9D9] text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition whitespace-nowrap">
                    Tìm kiếm
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Sân bóng</th>
                        <th class="px-6 py-3 text-center">Loại sân</th>
                        <th class="px-6 py-3 text-center">Sân đang liên kết</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($fields as $item)
                        <tr class="hover:bg-gray-50 border-gray-200">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">{{ $item->name }}</div>
                                <div class="text-sm text-gray-500 mt-1">{{ $item->address }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->fieldType->name }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->conflicts->count() > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($item->conflicts as $conflict)
                                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-700">
                                                {{ $conflict->name }} - {{ $conflict->fieldType->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">Chưa có sân liên kết</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button type="button"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700"
                                    onclick="openConflictModal(
                                        '{{ route('sanLienKet.update', $item->id) }}',
                                        '{{ $item->name }}',
                                        {{ $item->id }},
                                        @json($item->conflicts->pluck('id')->values())
                                    )">
                                    Thiết lập
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500">
                                Không có dữ liệu
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($fields->hasPages())
            <div class="flex justify-center items-center gap-2 mt-4">
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
    @include('admins.field_conflict._conflict_modal')
@endsection