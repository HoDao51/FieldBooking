<div id="editModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-2xl rounded-xl shadow-xl p-6 relative">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Chỉnh sửa thông tin nhân viên
            </h2>
            <button type="button" onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-700 text-xl">
                ✕
            </button>
        </div>

        <form id="editForm" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tên khách hàng -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1">Tên khách hàng</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập tên khách hàng"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">

                @error('name', 'edit')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SĐT -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1">Số điện thoại</label>
                <input type="text" name="phoneNumber" value="{{ old('phoneNumber') }}"
                    placeholder="Nhập số điện thoại"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">

                @error('phoneNumber', 'edit')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1">Email</label>
                <input readonly name="email" value="{{ old('email') }}" placeholder="Nhập email"
                    class="bg-gray-100 cursor-not-allowed w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">
            </div>

            <!-- ảnh đại diện -->
            <div>
                <label for="avatar" class="block text-lg text-[#4B5563] mb-1">Ảnh đại diện</label>

                <input type="file" name="avatar" id="avatar"
                    class="w-full border border-gray-300 rounded-md px-3 py-2">

                <!-- Avatar preview -->
                <img id="editAvatarPreview" src="" class="mt-2 w-24 h-24 object-cover rounded hidden">
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t">
                <button type="button" onclick="closeModal('editModal')"
                    class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                    Hủy
                </button>

                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Cập nhật
                </button>
            </div>

        </form>
    </div>
</div>
