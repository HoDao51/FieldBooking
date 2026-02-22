@extends('admins.layouts.app')

@section('content')
    <div class="pl-3 pt-3 h-screen">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 36 36" fill="currentColor">

                    <path fill="currentColor"
                        d="M18.42 16.31a5.7 5.7 0 1 1 5.76-5.7a5.74 5.74 0 0 1-5.76 5.7m0-9.4a3.7 3.7 0 1 0 3.76 3.7a3.74 3.74 0 0 0-3.76-3.7" />
                    <path fill="currentColor"
                        d="M18.42 16.31a5.7 5.7 0 1 1 5.76-5.7a5.74 5.74 0 0 1-5.76 5.7m0-9.4a3.7 3.7 0 1 0 3.76 3.7a3.74 3.74 0 0 0-3.76-3.7m3.49 10.74a20.6 20.6 0 0 0-13 2a1.77 1.77 0 0 0-.91 1.6v3.56a1 1 0 0 0 2 0v-3.43a18.92 18.92 0 0 1 12-1.68Z" />
                    <path fill="currentColor"
                        d="M33 22h-6.7v-1.48a1 1 0 0 0-2 0V22H17a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V23a1 1 0 0 0-1-1m-1 10H18v-8h6.3v.41a1 1 0 0 0 2 0V24H32Z" />
                    <path fill="currentColor"
                        d="M21.81 27.42h5.96v1.4h-5.96zM10.84 12.24a18 18 0 0 0-7.95 2A1.67 1.67 0 0 0 2 15.71v3.1a1 1 0 0 0 2 0v-2.9a16 16 0 0 1 7.58-1.67a7.3 7.3 0 0 1-.74-2m22.27 1.99a17.8 17.8 0 0 0-7.12-2a7.5 7.5 0 0 1-.73 2A15.9 15.9 0 0 1 32 15.91v2.9a1 1 0 1 0 2 0v-3.1a1.67 1.67 0 0 0-.89-1.48m-22.45-3.62v-.67a3.07 3.07 0 0 1 .54-6.11a3.15 3.15 0 0 1 2.2.89a8.2 8.2 0 0 1 1.7-1.08a5.13 5.13 0 0 0-9 3.27a5.1 5.1 0 0 0 4.7 5a7.4 7.4 0 0 1-.14-1.3m14.11-8.78a5.17 5.17 0 0 0-3.69 1.55a8 8 0 0 1 1.9 1a3.14 3.14 0 0 1 4.93 2.52a3.09 3.09 0 0 1-1.79 2.77a7 7 0 0 1 .06.93a8 8 0 0 1-.1 1.2a5.1 5.1 0 0 0 3.83-4.9a5.12 5.12 0 0 0-5.14-5.07" />
                </svg>

                <span>Quản lý nhân viên</span>
            </h1>

            <p class="text-gray-500 mt-1">
                Quản lý tài khoản nhân viên trong hệ thống
            </p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <!-- Search -->
            <form method="GET" action="{{ route('nhanVien.index') }}" class="flex items-center space-x-2 mb-2">
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
                Thêm nhân viên
            </button>
        </div>

        <!-- ===== TABLE ===== -->
        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Người dùng</th>
                        <th class="px-6 py-3 text-center">SĐT</th>
                        <th class="px-6 py-3 text-center">Vai trò</th>
                        <th class="px-6 py-3 text-center">Email</th>
                        <th class="px-6 py-3 text-center">Trạng thái</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($nhanVien as $item)
                        <tr class="hover:bg-gray-50">

                            <!-- Tên -->
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">
                                    {{ $item->name }}
                                </div>
                            </td>

                            <!-- SĐT -->
                            <td class="px-6 py-4 text-center">
                                {{ $item->phoneNumber ?? 'Chưa cập nhật' }}
                            </td>

                            <!-- Vai trò -->
                            <td class="px-6 py-4 text-center">
                                @if ($item->role == 0)
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                        Quản trị viên
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                        Nhân viên
                                    </span>
                                @endif
                            </td>

                            <!-- Email -->
                            <td class="px-6 py-4 text-center">
                                {{ $item->email }}
                            </td>

                            <!-- Trạng thái -->
                            <td class="px-6 py-4 text-center">
                                @if ($item->tinhTrang == 0)
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
                                @if ($item->tinhTrang == 0)
                                    <button type="button"
                                      onclick='openEditModal({
                                          modalId: "editModal",
                                          formId: "editForm",
                                          actionUrl: "{{ route("nhanVien.update", $item->id) }}",
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
                                        Đình chỉ
                                    </button>
                                @else
                                    @if ($item->tinhTrang == 0)
                                        <form action="{{ route('nhanVien.destroy', $item->id) }}" method="POST"
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
                                                Đình chỉ
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('restore', $item->id) }}" method="POST"
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

        @if ($nhanVien->hasPages())
            <div class="flex justify-center items-center gap-2 mt-6 mb-6">
                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $nhanVien->lastPage(); $i++)
                    @if ($i == $nhanVien->currentPage())
                        <span class="px-4 py-2 bg-blue-600 text-white rounded">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $nhanVien->url($i) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-blue-500 hover:text-white transition">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            </div>
        @endif

    </div>
    @include('admins.employee._create_modal')
    @include('admins.employee._edit_modal')
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                openModal();
            });
        </script>
    @endif
@endsection
