<div id="createModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-2xl rounded-xl shadow-xl p-6 relative">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Thêm giá theo khung giờ
            </h2>

            <button type="button"
                onclick="closeModal('createModal')"
                class="text-gray-400 hover:text-gray-700 text-xl">
                ✕
            </button>
        </div>

        <form action="{{ route('cauHinhGiaGio.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="hidden" name="field_id" value="{{ $field->id }}">

            <!-- Ngày trong tuần -->
            <div>
                <label class="block text-lg text-gray-600 mb-1">
                    Ngày trong tuần
                </label>

                <div class="relative">
                    <select name="day_of_week"
                        class="appearance-none text-[#4B5563] w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-1 focus:ring-green-400">

                        <option value="">-- Chọn ngày --</option>
                        <option value="0" {{ old('day_of_week') === 0 ? 'selected' : '' }}>Chủ nhật</option>
                        <option value="1" {{ old('day_of_week') == 1 ? 'selected' : '' }}>Thứ 2</option>
                        <option value="2" {{ old('day_of_week') == 2 ? 'selected' : '' }}>Thứ 3</option>
                        <option value="3" {{ old('day_of_week') == 3 ? 'selected' : '' }}>Thứ 4</option>
                        <option value="4" {{ old('day_of_week') == 4 ? 'selected' : '' }}>Thứ 5</option>
                        <option value="5" {{ old('day_of_week') == 5 ? 'selected' : '' }}>Thứ 6</option>
                        <option value="6" {{ old('day_of_week') == 6 ? 'selected' : '' }}>Thứ 7</option>
                    </select>

                    <!-- icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-500"
                            viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M13.069 5.157L8.384 9.768a.546.546 0 0 1-.768 0L2.93 5.158a.55.55 0 0 0-.771 0a.53.53 0 0 0 0 .759l4.684 4.61a1.65 1.65 0 0 0 2.312 0l4.684-4.61a.53.53 0 0 0 0-.76a.55.55 0 0 0-.771 0" />
                        </svg>
                    </div>
                </div>

                @error('day_of_week', 'create')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Khung giờ -->
            <div>
                <label class="block text-lg text-gray-600 mb-1">
                    Khung giờ
                </label>

                <div class="relative">
                    <select name="time_id"
                        class="appearance-none text-[#4B5563] w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-1 focus:ring-green-400">

                        <option value="">-- Chọn khung giờ --</option>
                        @foreach($timeSlots as $slot)
                            <option value="{{ $slot->id }}"
                                {{ old('time_id') == $slot->id ? 'selected' : '' }}>
                                {{ $slot->startTime }} - {{ $slot->endTime }}
                            </option>
                        @endforeach
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-500"
                            viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M13.069 5.157L8.384 9.768a.546.546 0 0 1-.768 0L2.93 5.158a.55.55 0 0 0-.771 0a.53.53 0 0 0 0 .759l4.684 4.61a1.65 1.65 0 0 0 2.312 0l4.684-4.61a.53.53 0 0 0 0-.76a.55.55 0 0 0-.771 0" />
                        </svg>
                    </div>
                </div>

                @error('time_id', 'create')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Giá -->
            <div>
                <label class="block text-lg text-gray-600 mb-1">
                    Giá (VNĐ)
                </label>

                <input type="number"
                    name="price"
                    value="{{ old('price') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-400"
                    placeholder="Nhập giá">

                @error('price', 'create')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Footer -->
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <button type="button"
                    onclick="closeModal('createModal')"
                    class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                    Hủy
                </button>

                <button type="submit"
                    class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Tạo mới
                </button>
            </div>

        </form>
    </div>
</div>