@extends('admins.layouts.app')

@section('content')
    <div class="pl-2" @if (session('modal') === 'edit') data-auto-open-modal="conflictModal" @endif>
        <div class="mb-6">
            <h1 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-dasharray="28" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2"
                        d="M13 6l2 -2c1 -1 3 -1 4 0l1 1c1 1 1 3 0 4l-5 5c-1 1 -3 1 -4 0M11 18l-2 2c-1 1 -3 1 -4 0l-1 -1c-1 -1 -1 -3 0 -4l5 -5c1 -1 3 -1 4 0" />
                </svg>
                <span>Thi&#7871;t l&#7853;p s&acirc;n li&ecirc;n k&#7871;t</span>
            </h1>
            <p class="text-gray-500 mt-1">
                C&#7845;u h&igrave;nh c&aacute;c s&acirc;n th&agrave;nh 1 c&#7909;m s&acirc;n s&#7869; kh&oacute;a c&ugrave;ng khung gi&#7901; v&#7899;i nhau
            </p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <form method="GET" action="{{ route('sanLienKet.index') }}" class="flex items-center space-x-2">
                <div class="relative w-[400px] rounded border border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M18.319 14.433A8.001 8.001 0 0 0 6.343 3.868a8 8 0 0 0 10.564 11.976l.043.045l4.242 4.243a1 1 0 1 0 1.415-1.415l-4.243-4.242zm-2.076-9.15a6 6 0 1 1-8.485 8.485a6 6 0 0 1 8.485-8.485"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="T&igrave;m theo t&ecirc;n s&acirc;n ho&#7863;c &#273;&#7883;a ch&#7881;"
                        class="bg-[#F2F2F2] pl-10 pr-3 py-2 rounded w-full focus:ring-2 focus:ring-green-400 outline-none">
                </div>
                <button type="submit"
                    class="bg-[#D9D9D9] text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition whitespace-nowrap">
                    T&igrave;m ki&#7871;m
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">S&acirc;n b&oacute;ng</th>
                        <th class="px-6 py-3 text-center">Lo&#7841;i s&acirc;n</th>
                        <th class="px-6 py-3 text-center">S&acirc;n &#273;ang li&ecirc;n k&#7871;t</th>
                        <th class="px-6 py-3 text-center">Thao t&aacute;c</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($fields as $item)
                        <tr class="hover:bg-gray-50 border-gray-200">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">{{ $item->name }}</div>
                                <div class="text-sm text-gray-500 mt-1">{{ $item->address }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->fieldType->name }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->conflicts->count() > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($item->conflicts as $conflict)
                                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-700">
                                                {{ $conflict->name }} - {{ $conflict->fieldType->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">Ch&#432;a c&oacute; s&acirc;n li&ecirc;n k&#7871;t</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button type="button"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700"
                                    onclick="openConflictModal(
                                        '{{ route('sanLienKet.update', $item->id) }}',
                                        '{{ $item->name }}',
                                        {{ $item->id }},
                                        @json($item->conflicts->pluck('id')->values())
                                    )">
                                    Thi&#7871;t l&#7853;p
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500">
                                Kh&ocirc;ng c&oacute; d&#7919; li&#7879;u
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($fields->hasPages())
            <div class="flex justify-center items-center gap-2 mt-4">
                @for ($i = 1; $i <= $fields->lastPage(); $i++)
                    @if ($i == $fields->currentPage())
                        <span class="px-4 py-2 bg-green-600 text-white rounded">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $fields->url($i) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            </div>
        @endif
    </div>
    @include('admins.field_conflict._conflict_modal')
@endsection