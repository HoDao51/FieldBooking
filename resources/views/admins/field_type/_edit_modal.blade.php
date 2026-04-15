<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="relative w-full max-w-xl rounded-xl bg-white p-6 shadow-xl">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Chỉnh sửa loại sân</h2>
            <button type="button" onclick="closeModal('editModal')" class="text-xl text-red-500 hover:text-red-700">
                ×
            </button>
        </div>

        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="mb-1 block text-gray-600">Tên loại sân</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ví dụ: Sân 7 người"
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

