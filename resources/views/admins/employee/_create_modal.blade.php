<div id="createModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-2xl rounded-xl shadow-xl p-6 relative">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Thêm nhân viên mới
            </h2>
            <button onclick="closeModal('createModal')" class="text-gray-400 hover:text-gray-700 text-xl">
                ✕
            </button>
        </div>

        <form action="{{ route('nhanVien.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Tên nhân viên -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1" for="name">Tên nhân viên</label>
                <input type="text" value="{{ old('name') }}" name="name" id="name"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập tên nhân viên">
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Chức vụ -->
            <div class="mb-4">
                <label class="block text-lg text-[#4B5563] mb-1" for="role">Chức vụ</label>
                <div class="relative">
                    <select name="role" id="role"
                        class="appearance-none text-[#4B5563] w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-1 focus:ring-green-400">
                        <option value="" disabled {{ old('role') === null ? 'selected' : '' }}>-- Chọn chức vụ
                            --</option>
                        <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Quản trị viên</option>
                        <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Nhân viên</option>
                    </select>
                    <!-- icon mũi tên -->
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4B5563]" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M13.069 5.157L8.384 9.768a.546.546 0 0 1-.768 0L2.93 5.158a.55.55 0 0 0-.771 0a.53.53 0 0 0 0 .759l4.684 4.61a1.65 1.65 0 0 0 2.312 0l4.684-4.61a.53.53 0 0 0 0-.76a.55.55 0 0 0-.771 0" />
                        </svg>
                    </div>
                </div>
                @error('role')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Số điện thoại -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1" for="phoneNumber">Số điện thoại</label>
                <input type="text" value="{{ old('phoneNumber') }}" name="phoneNumber" id="phoneNumber"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập số điện thoại">
                @error('phoneNumber')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1" for="email">Email</label>
                <input type="email" value="{{ old('email') }}" name="email" id="email"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập email">
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t">
                <button type="button" onclick="closeModal('createModal')"
                    class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                    Hủy
                </button>

                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Tạo mới
                </button>
            </div>

        </form>
    </div>
</div>
