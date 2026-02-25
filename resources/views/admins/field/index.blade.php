@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 256 256"
                    stroke="currentColor" stroke-width="3">
                    <path fill="currentColor"
                        d="M128 66a38 38 0 1 0 38 38a38 38 0 0 0-38-38m0 64a26 26 0 1 1 26-26a26 26 0 0 1-26 26m0-112a86.1 86.1 0 0 0-86 86c0 30.91 14.34 63.74 41.47 94.94a252.3 252.3 0 0 0 41.09 38a6 6 0 0 0 6.88 0a252.3 252.3 0 0 0 41.09-38c27.13-31.2 41.47-64 41.47-94.94a86.1 86.1 0 0 0-86-86m0 206.51C113 212.93 54 163.62 54 104a74 74 0 0 1 148 0c0 59.62-59 108.93-74 120.51" />
                </svg>

                <span>Quản lý sân bóng</span>
            </h1>

            <p class="text-gray-500 mt-1">
                Quản lý tất cả sân bóng trong hệ thống
            </p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <!-- Search -->
            <form method="GET" action="{{ route('sanBong.index') }}" class="flex items-center space-x-2 mb-2">
                <!-- Thanh tìm kiếm -->
                <div class="relative w-[400px] rounded border border-gray-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Tìm kiếm theo tên, địa chỉ,..."
                        class="bg-[#F2F2F2] pl-10 pr-3 py-2 rounded w-full d-lg focus:ring-2 focus:ring-green-400 outline-none">
                </div>
                <!-- Nút tìm kiếm -->
                <button type="submit" class="bg-[#D9D9D9] text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    Tìm kiếm
                </button>
            </form>

            <!-- Add button -->
            <button onclick="openModal('createModal')"
                class="flex bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1" fill="#ffffff" viewBox="0 0 32 32">
                    <path fill="currentColor"
                        d="M16 3C8.832 3 3 8.832 3 16s5.832 13 13 13s13-5.832 13-13S23.168 3 16 3m0 2c6.087 0 11 4.913 11 11s-4.913 11-11 11S5 22.087 5 16S9.913 5 16 5m-1 5v5h-5v2h5v5h2v-5h5v-2h-5v-5z" />
                </svg>
                Thêm sân bóng
            </button>
        </div>
        
        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Sân bóng</th>
                        <th class="px-6 py-3 text-center">Địa chỉ</th>
                        <th class="px-6 py-3 text-center">Loại sân</th>
                        <th class="px-6 py-3 text-center">Trạng thái</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($sanBong as $item)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-x-3">
                                    <!-- ảnh sân -->
                                    <div class="w-12 h-12 rounded overflow-hidden">
                                        @if ($item->images->first())
                                            <img src="{{ asset('storage/' . $item->images->first()->name) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('images/sbcf-default-avatar.png') }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>

                                    <!-- Name + Email -->
                                    <div class="flex flex-col text-2x1">
                                        <span class="font-semibold text-gray-800">
                                            {{ $item->name }}
                                        </span>
                                    </div>

                                </div>
                            </td>

                            <!-- SĐT -->
                            <td class="px-6 py-4 text-center">
                                {{ $item->address }}
                            </td>

                            <!-- loại sân -->
                            <td class="px-6 py-4 text-center">
                                {{ $item->fieldType->name }}
                            </td>

                            <!-- Trạng thái -->
                            <td class="px-6 py-4 text-center">
                                @if ($item->status == 0)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        Hoạt động
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                        Ngưng hoạt động
                                    </span>
                                @endif
                            </td>

                            <!-- Thao tác -->
                            <td class="px-2 py-2 border text-center">
                                <button
                                    onclick='openEditModal({
                                        modalId: "editModal",
                                        formId: "editForm",
                                        actionUrl: "{{ route('sanBong.update', $item->id) }}",
                                        data: {
                                            name: "{{ $item->name }}",
                                            address: "{{ $item->address }}",
                                            type_id: "{{ $item->type_id }}",
                                            images: @json($item->images)
                                        }
                                    })'
                                    class="bg-[#10B981] text-white text-[16px] font-semibold px-3 py-2 rounded hover:bg-[#1D8F6A]">
                                    Sửa
                                </button>
                                <!-- Nút xóa -->
                                <form action="{{ route('sanBong.destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-[#DC2626] text-white text-[16px] font-semibold px-3 py-2 rounded hover:bg-red-800 ml-2">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">
                                Không có dữ liệu
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        @if ($sanBong->hasPages())
            <div class="flex justify-center items-center gap-2 mt-6">
                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $sanBong->lastPage(); $i++)
                    @if ($i == $sanBong->currentPage())
                        <span class="px-4 py-2 bg-green-600 text-white rounded">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $sanBong->url($i) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            </div>
        @endif

    </div>
    @include('admins.field._create_modal')
    @include('admins.field._edit_modal')
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
