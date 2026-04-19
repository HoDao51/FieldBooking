@extends('admins.layouts.app')

@section('content')
    <div class="pl-2">
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
                        Cụm sân: {{ $facility->name }}
                    </h1>
                    <p class="text-gray-500 mt-1">
                        Chọn sân để cấu hình giá theo khung giờ
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($fields as $field)
                <a href="{{ route('cauHinhGiaGio.show', $field->id) }}"
                    class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-green-400 transition p-4 flex gap-4">
                    <!-- ẢNH -->
                    <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                        @if ($field->images->first())
                            <img src="{{ asset('storage/' . $field->images->first()->name) }}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/banner-client-placeholder.jpg') }}" class="w-full h-full object-cover">
                        @endif
                    </div>

                    <!-- THÔNG TIN -->
                    <div class="flex flex-col justify-center">

                        <h3 class="font-semibold text-gray-800 text-base">
                            {{ $field->name }}
                        </h3>

                        <p class="text-xs text-gray-500">
                            {{ $facility->address }}
                        </p>

                        <div class="mt-1 flex items-center gap-2 text-xs">
                            <!-- Loại sân -->
                            <span class="px-2 py-0.5 text-xs rounded-full bg-gray-100 text-gray-600">
                                @if ($field->fieldType)
                                    {{ $field->fieldType->name }}
                                @endif
                            </span>
                        </div>

                    </div>
                </a>

            @empty
                <div class="col-span-3 text-center py-10 text-gray-500">
                    Không có sân nào trong cụm sân này
                </div>
            @endforelse
        </div>
    </div>
@endsection