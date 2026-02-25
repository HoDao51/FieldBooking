@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="0">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5">
                        <path
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M16 3.128a4 4 0 0 1 0 7.744M22 21v-2a4 4 0 0 0-3-3.87" />
                        <circle cx="9" cy="7" r="4" />
                    </g>
                </svg>

                <span>Quản lý thông tin khách hàng</span>
            </h1>

            <p class="text-gray-500 mt-1">
                Quản lý tài khoản khách hàng trong hệ thống
            </p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <!-- Search -->
            <form method="GET" action="{{ route('khachHang.index') }}" class="flex items-center space-x-2 mb-2">
                <!-- Thanh tìm kiếm -->
                <div class="relative w-[400px] rounded border border-gray-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Tìm kiếm theo tên, email,..."
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
                Thêm khách hàng
            </button>
        </div>

        <!-- ===== TABLE ===== -->
        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Người dùng</th>
                        <th class="px-6 py-3 text-center">Số điện thoại</th>
                        <th class="px-6 py-3 text-center">Trạng thái</th>
                        <th class="px-6 py-3 text-center">Ngày tạo</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($khachHang as $item)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-x-3">

                                    <!-- Avatar -->
                                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-300">
                                        @if ($item->avatar == null)
                                        <img src="{{asset('images/sbcf-default-avatar.png')}}" alt="Ảnh đại diện"
                                            class="w-full h-full object-cover">
                                        @else
                                        <img src="{{ asset('storage/' . $item->avatar) }}" alt="Ảnh đại diện"
                                            class="w-full h-full object-cover">
                                        @endif
                                    </div>

                                    <!-- Name + Email -->
                                    <div class="flex flex-col text-2x1">
                                        <span class="font-semibold text-gray-800">
                                            {{ $item->name }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            {{ $item->email }}
                                        </span>
                                    </div>

                                </div>
                            </td>

                            <!-- SĐT -->
                            <td class="px-6 py-4 text-center">
                                {{ $item->phoneNumber }}
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

                            <!-- Email -->
                            <td class="px-6 py-4 text-center">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>

                            <!-- Thao tác -->
                            <td class="px-2 py-2 border text-center">
                                @if ($item->status == 0)
                                    <button type="button"
                                        onclick='openEditModal({
                                          modalId: "editModal",
                                          formId: "editForm",
                                          actionUrl: "{{ route('khachHang.update', $item->id) }}",
                                          data: @json($item)
                                      })'
                                        class="bg-[#10B981] text-white text-[16px] font-semibold px-3 py-2 rounded hover:bg-[#1D8F6A]">
                                        Sửa
                                    </button>
                                @else
                                    <button
                                        type="button"class="bg-[#10B981] cursor-not-allowed text-white text-[16px] font-semibold px-3 py-2 rounded hover:bg-[#1D8F6A]">
                                        Sửa
                                    </button>
                                @endif

                                @if (auth()->user()->id == $item->user_id)
                                    <button
                                        class="bg-[#DC2626] cursor-not-allowed text-white text-[16px] font-semibold px-[18px] py-2 rounded ml-2 mt-2 mb-2">
                                        Vô hiệu
                                    </button>
                                @else
                                    @if ($item->status == 0)
                                        <form action="{{ route('khachHang.destroy', $item->id) }}" method="POST"
                                            class="inline-block mt-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="
                                if (confirm('Bạn có chắc muốn vô hiệu hóa tài khoản này không?')) {
                                    showLoader();
                                } else {
                                    return false;
                                }"
                                                class="bg-[#DC2626] text-white text-[16px] font-semibold px-[18px] py-2 rounded hover:bg-red-800 ml-2">
                                                Vô hiệu
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('khachHang.restore', $item->id) }}" method="POST"
                                            class="inline-block mt-3">
                                            @csrf
                                            @method('POST')
                                            <button type="submit"
                                                onclick="
                                if (confirm('Bạn có chắc muốn khôi phục tài khoản này không?')) {
                                    showLoader();
                                } else {
                                    return false;
                                }"
                                                class="bg-[#F97316] text-white text-[16px] font-semibold px-3 py-2 rounded hover:bg-[#C55E17] ml-2">
                                                Khôi phục
                                            </button>
                                        </form>
                                    @endif
                                @endif
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

        @if ($khachHang->hasPages())
            <div class="flex justify-center items-center gap-2 mt-6">
                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $khachHang->lastPage(); $i++)
                    @if ($i == $khachHang->currentPage())
                        <span class="px-4 py-2 bg-green-600 text-white rounded">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $khachHang->url($i) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            </div>
        @endif

    </div>
    @include('admins.customer._create_modal')
    @include('admins.customer._edit_modal')
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
