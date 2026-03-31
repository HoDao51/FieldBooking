<div id="createModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-2xl rounded-xl shadow-xl p-6 relative">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Thêm khách hàng mới
            </h2>
            <button onclick="closeModal('createModal')" class="text-red-500 hover:text-red-700 text-xl">
                <svg y="0" xmlns="http://www.w3.org/2000/svg" x="0" width="100" viewBox="0 0 100 100"
                    preserveAspectRatio="xMidYMid meet" height="100" class="w-12 h-12 fill-current">
                    <path fill-rule="evenodd"
                        d="M50,87.4A37.4,37.4,0,1,0,12.6,50,37.3,37.3,0,0,0,50,87.4ZM44,37.3A4.7,4.7,0,0,0,37.3,44l6.1,6-6.1,6A4.7,4.7,0,0,0,44,62.7l6-6.1,6,6.1A4.7,4.7,0,0,0,62.7,56l-6.1-6,6.1-6A4.7,4.7,0,0,0,56,37.3l-6,6.1Z">
                    </path>
                </svg>
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
