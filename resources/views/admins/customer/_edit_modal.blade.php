<div id="editModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-2xl rounded-xl shadow-xl p-6 relative">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Chỉnh sửa thông tin nhân viên
            </h2>
            <button type="button" onclick="closeModal('editModal')" class="text-red-500 hover:text-red-700 text-xl">
                <svg y="0" xmlns="http://www.w3.org/2000/svg" x="0" width="100" viewBox="0 0 100 100"
                    preserveAspectRatio="xMidYMid meet" height="100" class="w-12 h-12 fill-current">
                    <path fill-rule="evenodd"
                        d="M50,87.4A37.4,37.4,0,1,0,12.6,50,37.3,37.3,0,0,0,50,87.4ZM44,37.3A4.7,4.7,0,0,0,37.3,44l6.1,6-6.1,6A4.7,4.7,0,0,0,44,62.7l6-6.1,6,6.1A4.7,4.7,0,0,0,62.7,56l-6.1-6,6.1-6A4.7,4.7,0,0,0,56,37.3l-6,6.1Z">
                    </path>
                </svg>
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
                    class="w-full border border-gray-300 rounded-md bg-gray-50 px-3 py-2 text-gray-700 focus:outline-none focus:ring-1 focus:ring-green-400">

                <!-- Avatar preview -->
                <img id="editAvatarPreview" src="" class="mt-2 w-24 h-24 object-cover rounded hidden">
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
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
