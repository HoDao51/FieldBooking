@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 opacity-70 text-green-600" fill="#222C3A"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M20 18H4V8h16m0-2h-8l-2-2H4c-1.11 0-2 .89-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2" />
                </svg>
                <span>Quản lý loại sân</span>
            </h1>
            <p class="mt-1 text-gray-500">Quản lý các loại sân trong hệ thống</p>
        </div>

        <div class="mb-2 flex items-center justify-between">
            <form method="GET" action="{{ route('loaiSan.index') }}" class="mb-2 flex items-center space-x-2">
                <div class="relative w-[400px] rounded border border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Tìm kiếm loại sân"
                        class="w-full rounded bg-[#F2F2F2] py-2 pl-10 pr-3 outline-none focus:ring-2 focus:ring-green-400">
                </div>
                <button type="submit"
                    class="whitespace-nowrap rounded bg-[#D9D9D9] px-4 py-2 text-gray-800 transition hover:bg-gray-400">
                    Tìm kiếm
                </button>
            </form>

            <button onclick="openModal('createModal')"
                class="flex whitespace-nowrap rounded-lg bg-green-600 px-3 py-2 font-semibold text-white transition hover:bg-green-700">
                Thêm loại sân
            </button>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-xs uppercase text-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left">Tên loại sân</th>
                        <th class="px-6 py-3 text-center">Ngày tạo</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($fieldTypes as $item)
                        <tr class="border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->created_at->format('d-m-Y') }}</td>
                            <td class="whitespace-nowrap px-2 py-2 text-center">
                                <button type="button"
                                    onclick='openEditModal({
                                        modalId: "editModal",
                                        formId: "editForm",
                                        actionUrl: "{{ route('loaiSan.update', $item->id) }}",
                                        data: @json($item)
                                    })'
                                    class="rounded bg-[#10B981] px-3 py-2 font-semibold text-white hover:bg-[#1D8F6A]">
                                    Sửa
                                </button>

                                <form action="{{ route('loaiSan.destroy', $item->id) }}" method="POST"
                                    class="ml-2 inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Bạn có chắc muốn xóa loại sân này không?')"
                                        class="rounded bg-[#DC2626] px-3 py-2 font-semibold text-white hover:bg-red-800">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-500">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($fieldTypes->hasPages())
            <div class="mt-4 flex items-center justify-center gap-2">
                @for ($i = 1; $i <= $fieldTypes->lastPage(); $i++)
                    @if ($i == $fieldTypes->currentPage())
                        <span class="rounded bg-green-600 px-4 py-2 text-white">{{ $i }}</span>
                    @else
                        <a href="{{ $fieldTypes->url($i) }}"
                            class="rounded bg-gray-200 px-4 py-2 text-gray-700 transition hover:bg-green-500 hover:text-white">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            </div>
        @endif
    </div>

    @include('admins.field_type._create_modal')
    @include('admins.field_type._edit_modal')

    @if (session('modal') === 'create')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                openModal('createModal');
            });
        </script>
    @endif

    @if (session('modal') === 'edit')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                openModal('editModal');
            });
        </script>
    @endif
@endsection
