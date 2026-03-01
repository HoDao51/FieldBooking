@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">

            <div class="flex items-center gap-3">
                <a href="{{ route('cauHinhGiaGio.index') }}" class="text-gray-600 hover:text-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m12 19l-7-7l7-7m7 7H5" />
                    </svg>
                </a>
                <div class="ml-2">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Bảng giá: {{ $field->name }}
                    </h1>
                    <p class="text-gray-500 mt-1">
                        Cấu hình giá theo khung giờ và ngày trong tuần
                    </p>
                </div>
            </div>

            <!-- Add button -->
            <button onclick="openModal('createModal')"
                class="flex bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1" fill="#ffffff" viewBox="0 0 32 32">
                    <path fill="currentColor"
                        d="M16 3C8.832 3 3 8.832 3 16s5.832 13 13 13s13-5.832 13-13S23.168 3 16 3m0 2c6.087 0 11 4.913 11 11s-4.913 11-11 11S5 22.087 5 16S9.913 5 16 5m-1 5v5h-5v2h5v5h2v-5h5v-2h-5v-5z" />
                </svg>
                Thêm giá mới
            </button>

        </div>

        @php
            $days = [
                1 => 'Thứ 2',
                2 => 'Thứ 3',
                3 => 'Thứ 4',
                4 => 'Thứ 5',
                5 => 'Thứ 6',
                6 => 'Thứ 7',
                0 => 'Chủ nhật',
            ];
        @endphp

        {{-- HIỂN THỊ THEO TỪNG NGÀY --}}
        @foreach ($days as $key => $label)
            <div class="bg-white rounded-xl shadow border mb-6 overflow-hidden">

                {{-- HEADER NGÀY --}}
                <div class="bg-green-600 text-white px-4 py-3 font-semibold">
                    {{ $label }}
                </div>

                {{-- DANH SÁCH GIÁ --}}
                @if (isset($prices[$key]))
                    @foreach ($prices[$key] as $price)
                        <div class="flex justify-between items-center px-4 py-3 border-t hover:bg-gray-50">

                            <div class="flex items-center gap-6">

                                {{-- Khung giờ --}}
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M11.5 3a9.5 9.5 0 0 1 9.5 9.5a9.5 9.5 0 0 1-9.5 9.5A9.5 9.5 0 0 1 2 12.5A9.5 9.5 0 0 1 11.5 3m0 1A8.5 8.5 0 0 0 3 12.5a8.5 8.5 0 0 0 8.5 8.5a8.5 8.5 0 0 0 8.5-8.5A8.5 8.5 0 0 0 11.5 4M11 7h1v5.42l4.7 2.71l-.5.87l-5.2-3z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($price->timeSlot->startTime)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($price->timeSlot->endTime)->format('H:i') }}
                                </div>

                                <!-- Giá -->
                                <div class="flex items-center font-semibold text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600 mr-1"
                                        viewBox="0 0 56 56" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M29 30v10c3.519-.316 5-2.287 5-4.89c0-2.507-1.152-3.99-5-5.11m-3-5v-9c-3.273.415-5 2.33-5 4.43s1.364 3.647 5 4.57m2.84.737l1.072.277C35.784 27.423 39 29.917 39 34.836c0 5.658-4.466 8.868-10.16 9.284V48h-2.523v-3.88c-5.672-.439-10.16-3.741-10.317-9.284h4.622c.402 2.702 2.1 4.688 5.695 5.08V29.849l-.916-.231c-5.672-1.363-8.731-3.996-8.731-8.684c0-5.173 4.02-8.591 9.647-9.03V8h2.523v3.903c5.582.462 9.624 3.926 9.803 9.169h-4.645c-.29-2.91-2.3-4.596-5.158-4.966z" />
                                    </svg>

                                    {{ number_format($price->price) }} ₫
                                </div>

                            </div>

                            {{-- ACTION --}}
                            <div class="flex items-center gap-4 text-gray-500">
                                <button type="button"
                                        onclick='openEditModal({
                                          modalId: "editModal",
                                          formId: "editForm",
                                          actionUrl: "{{ route('cauHinhGiaGio.update', $price->id) }}",
                                          data: @json($price)
                                      })'
                                        class="bg-[#10B981] text-white text-[16px] font-semibold px-3 py-2 rounded hover:bg-[#1D8F6A]">
                                        Sửa
                                    </button>
                                <!-- Nút xóa -->
                                <form action="{{ route('sanBong.destroy', $price->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-[#DC2626] text-white text-[16px] font-semibold px-3 py-2 rounded hover:bg-red-800 ml-2">
                                        Xóa
                                    </button>
                                </form>

                            </div>

                        </div>
                    @endforeach
                @else
                    <div class="px-4 py-4 text-gray-400">
                        Chưa có giá cho ngày này
                    </div>
                @endif

            </div>
        @endforeach

    </div>
    @include('admins.pricing_configuration._create_modal')
    @include('admins.pricing_configuration._edit_modal')
    @if (session('modal') === 'create')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                openModal('createModal');
            });
        </script>
    @endif

    @if (session('modal') === 'edit')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                openModal('editModal');
            });
        </script>
    @endif
@endsection
