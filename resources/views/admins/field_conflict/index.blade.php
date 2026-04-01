@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M7 7a3 3 0 1 1 3-3a3 3 0 0 1-3 3m10 13a3 3 0 1 1 3-3a3 3 0 0 1-3 3M7 20a3 3 0 1 1 3-3a3 3 0 0 1-3 3m8.59-11L10.4 6.4l1.2-1.8l5.19 2.59zM10.4 17.6L15.59 15l1 1.81l-5.19 2.59z" />
                </svg>
                <span>Thiết lập sân liên kết</span>
            </h1>
            <p class="text-gray-500 mt-1">
                Cấu hình các sân sẽ khóa cùng khung giờ với nhau
            </p>
        </div>

        <div class="mb-5 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
            Dùng cho các trường hợp như 1 sân 11 người có thể tách thành 2 sân 5 người. Khi một sân trong cụm được đặt,
            các sân liên kết còn lại sẽ tự khóa cùng khung giờ.
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

        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Sân bóng</th>
                        <th class="px-6 py-3 text-center">Loại sân</th>
                        <th class="px-6 py-3 text-left">Sân đang liên kết</th>
                        <th class="px-6 py-3 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($fields as $item)
                        <tr class="hover:bg-gray-50">
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
                                    onclick='openConflictModal({
                                        actionUrl: "{{ route('sanLienKet.update', $item->id) }}",
                                        fieldName: "{{ $item->name }}",
                                        fieldId: "{{ $item->id }}",
                                        conflictFields: @json($item->conflicts->pluck('id')->values())
                                    })'>
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

    <div id="conflictModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
        <div class="bg-white w-full max-w-3xl rounded-xl shadow-xl p-6 relative">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Thiết lập sân liên kết</h2>
                    <p id="conflictFieldName" class="text-sm text-gray-500 mt-1"></p>
                </div>
                <button type="button" onclick="closeModal('conflictModal')" class="text-red-500 hover:text-red-700 text-xl">
                    <svg y="0" xmlns="http://www.w3.org/2000/svg" x="0" width="100" viewBox="0 0 100 100"
                        preserveAspectRatio="xMidYMid meet" height="100" class="w-12 h-12 fill-current">
                        <path fill-rule="evenodd"
                            d="M50,87.4A37.4,37.4,0,1,0,12.6,50,37.3,37.3,0,0,0,50,87.4ZM44,37.3A4.7,4.7,0,0,0,37.3,44l6.1,6-6.1,6A4.7,4.7,0,0,0,44,62.7l6-6.1,6,6.1A4.7,4.7,0,0,0,62.7,56l-6.1-6,6.1-6A4.7,4.7,0,0,0,56,37.3l-6,6.1Z">
                        </path>
                    </svg>
                </button>
            </div>

            <form id="conflictForm" method="POST" class="mt-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <input type="text" id="conflictSearch" placeholder="Tìm nhanh sân cần liên kết"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                </div>

                <div id="conflictList" class="max-h-80 overflow-y-auto rounded-lg border border-gray-300 bg-gray-50 p-3 space-y-2">
                    @foreach ($allFields as $item)
                        <label class="flex items-start gap-2 text-sm text-gray-700 conflict-item"
                            data-name="{{ strtolower($item->name . ' ' . $item->fieldType->name . ' ' . $item->address) }}"
                            data-id="{{ $item->id }}">
                            <input type="checkbox" name="conflict_fields[]" value="{{ $item->id }}"
                                class="mt-1 rounded border-gray-300 text-green-600 focus:ring-green-500 conflict-checkbox">
                            <span>{{ $item->name }} - {{ $item->fieldType->name }}</span>
                        </label>
                    @endforeach
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t mt-4">
                    <button type="button" onclick="closeModal('conflictModal')"
                        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                        Hủy
                    </button>
                    <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Lưu liên kết
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentConflictFieldId = null;

        function openConflictModal(data) {
            const form = document.getElementById('conflictForm');
            const fieldName = document.getElementById('conflictFieldName');
            const searchInput = document.getElementById('conflictSearch');
            const items = document.querySelectorAll('.conflict-item');
            const checkboxes = document.querySelectorAll('.conflict-checkbox');

            currentConflictFieldId = parseInt(data.fieldId);
            form.action = data.actionUrl;
            fieldName.innerText = data.fieldName;
            searchInput.value = '';

            items.forEach(item => {
                item.style.display = 'flex';

                if (parseInt(item.dataset.id) === currentConflictFieldId) {
                    item.style.display = 'none';
                }
            });

            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            if (data.conflictFields) {
                checkboxes.forEach(checkbox => {
                    data.conflictFields.forEach(conflictId => {
                        if (parseInt(checkbox.value) === parseInt(conflictId)) {
                            checkbox.checked = true;
                        }
                    });
                });
            }

            openModal('conflictModal');
        }

        document.getElementById('conflictSearch').addEventListener('input', function() {
            const keyword = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.conflict-item');

            items.forEach(item => {
                const itemId = parseInt(item.dataset.id);

                if (itemId === currentConflictFieldId) {
                    item.style.display = 'none';
                    return;
                }

                if (keyword === '' || item.dataset.name.indexOf(keyword) !== -1) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
@endsection
