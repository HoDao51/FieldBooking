<div id="conflictModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-3xl rounded-xl shadow-xl p-6 relative">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    Thiết lập sân liên kết
                </h2>

                <p id="conflictFieldName" class="text-sm text-gray-500 mt-1">
                </p>
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
            <!-- SEARCH -->
            <div class="mb-3">
                <input type="text" id="conflictSearch" placeholder="Tìm nhanh sân cần liên kết"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                           focus:outline-none focus:ring-1 focus:ring-green-400">
            </div>

            <div id="conflictList" class="max-h-[320px] overflow-y-auto rounded-lg border border-gray-300
                bg-gray-50 p-3 space-y-2">
                @foreach ($allFields as $item)
                    <label
                        class="flex items-start gap-2 text-sm text-gray-700
                               conflict-item
                               hover:bg-white
                               p-2 rounded
                               cursor-pointer"
                        data-name="{{ strtolower($item->name . ' ' . $item->fieldType->name . ' ' . $item->address) }}"
                        data-id="{{ $item->id }}">

                        <input type="checkbox" name="conflict_fields[]" value="{{ $item->id }}"
                            class="mt-1 rounded border-gray-300
                                   text-green-600
                                   focus:ring-green-500
                                   conflict-checkbox">
                        <span>
                            {{ $item->name }}
                            -
                            {{ $item->fieldType->name }}
                        </span>
                    </label>
                @endforeach
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t mt-4">
                <button type="button" onclick="closeModal('conflictModal')" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                    Hủy
                </button>

                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Lưu liên kết
                </button>
            </div>
        </form>
    </div>
</div>
