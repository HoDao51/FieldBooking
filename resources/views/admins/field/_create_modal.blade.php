<div id="createModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-2xl rounded-xl shadow-xl p-6 relative">

        <div class="flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-800">
                Thêm sân bóng mới
            </h1>
            <button type="button" onclick="closeModal('createModal')" class="text-gray-400 hover:text-gray-700 text-xl">
                ✕
            </button>
        </div>

        <form action="{{ route('sanBong.store') }}" method="POST" enctype="multipart/form-data" class="space-y-1">
            @csrf

            <!-- Tên sân -->
            <div>
                <label class="block text-lg text-gray-600">Tên sân bóng</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập tên sân bóng">
                @error('name', 'create')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Địa chỉ -->
            <div>
                <label class="block text-lg text-gray-600">Địa chỉ</label>
                <input type="text" name="address" value="{{ old('address') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập địa chỉ">
                @error('address', 'create')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Loại sân -->
            <div>
                <label class="block text-lg text-gray-600">Loại sân</label>
                <div class="relative">
                    <select name="type_id"
                        class="appearance-none text-[#4B5563] w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-1 focus:ring-green-400">
                        <option value="">-- Chọn loại sân --</option>
                        @foreach ($fieldTypes as $type)
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    <!-- icon mũi tên -->
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4B5563]" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M13.069 5.157L8.384 9.768a.546.546 0 0 1-.768 0L2.93 5.158a.55.55 0 0 0-.771 0a.53.53 0 0 0 0 .759l4.684 4.61a1.65 1.65 0 0 0 2.312 0l4.684-4.61a.53.53 0 0 0 0-.76a.55.55 0 0 0-.771 0" />
                        </svg>
                    </div>
                </div>
                @error('type_id', 'create')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload nhiều ảnh -->
            <div>
                <label class="block text-lg text-gray-600 mb-2">Hình ảnh sân</label>

                <!-- Preview images -->
                <div id="previewContainer" class="flex flex-wrap gap-3 mb-3"></div>

                <!-- Upload box -->
                <label
                    class="flex items-center justify-center gap-2 w-full h-32 border-2 border-dashed border-gray-300 rounded-lg 
                    cursor-pointer text-gray-500 hover:text-green-600 hover:border-green-500 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path fill="currentColor"
                                d="M11 16V7.85l-2.6 2.6L7 9l5-5l5 5l-1.4 1.45l-2.6-2.6V16zm-5 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                        </svg>

                        <span>Nhấn để tải ảnh lên</span>
                    </div>

                    <input type="file" name="images[]" id="imageInput" multiple accept="image/*" class="hidden">
                </label>

                @error('images', 'create')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
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
