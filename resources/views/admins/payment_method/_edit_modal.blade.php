<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="relative w-full max-w-xl rounded-xl bg-white p-6 shadow-xl">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Chỉnh sửa phương thức thanh toán</h2>
            <button type="button" onclick="closeModal('editModal')" class="text-red-500 hover:text-red-700 text-xl">
                <svg y="0" xmlns="http://www.w3.org/2000/svg" x="0" width="100" viewBox="0 0 100 100"
                    preserveAspectRatio="xMidYMid meet" height="100" class="w-12 h-12 fill-current">
                    <path fill-rule="evenodd"
                        d="M50,87.4A37.4,37.4,0,1,0,12.6,50,37.3,37.3,0,0,0,50,87.4ZM44,37.3A4.7,4.7,0,0,0,37.3,44l6.1,6-6.1,6A4.7,4.7,0,0,0,44,62.7l6-6.1,6,6.1A4.7,4.7,0,0,0,62.7,56l-6.1-6,6.1-6A4.7,4.7,0,0,0,56,37.3l-6,6.1Z">
                    </path>
                </svg>
            </button>
        </div>

        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="mb-1 block text-gray-600">Tên phương thức</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập phương thức thanh toán"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
                @error('name', 'edit')
                    <p class="mt-1 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 border-t border-gray-200 pt-4">
                <button type="button" onclick="closeModal('editModal')"
                    class="rounded-lg bg-gray-300 px-4 py-2 hover:bg-gray-400">
                    Hủy
                </button>
                <button type="submit" class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>

