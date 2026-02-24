<div id="createModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-2xl rounded-xl shadow-xl p-6 relative">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Thêm khách hàng mới
            </h2>
            <button onclick="closeModal('createModal')" class="text-gray-400 hover:text-gray-700 text-xl">
                ✕
            </button>
        </div>

        <form action="{{ route('khachHang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Tên khách hàng -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1" for="name">Tên khách hàng</label>
                <input type="text" value="{{ old('name') }}" name="name" id="name"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập tên khách hàng">
                @error('name', 'create')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- mật khẩu -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1" for="password">Mật khẩu</label>
                <input type="password" value="{{ old('password') }}" name="password" id="password" autocomplete="new-password"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập mật khẩu">
                @error('password', 'create')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>


            <!-- Số điện thoại -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1" for="phoneNumber">Số điện thoại</label>
                <input type="text" value="{{ old('phoneNumber') }}" name="phoneNumber" id="phoneNumber"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập số điện thoại">
                @error('phoneNumber', 'create')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1" for="email">Email</label>
                <input type="email" value="{{ old('email') }}" name="email" id="email"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập email">
                @error('email', 'create')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Avatar -->
            <div>
                <label class="block text-lg text-[#4B5563] mb-1" for="avatar">Avatar</label>

                <input type="file" value="{{ old('avatar') }}" name="avatar" id="avatar" accept="image/*"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400">

                @error('avatar', 'create')
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
