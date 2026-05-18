@if ($paginator->hasPages())
    @php
        if (!isset($containerClass)) {
            $containerClass = 'flex justify-center items-center gap-2 mt-6 flex-wrap';
        }

        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $candidatePages = [1, $currentPage - 1, $currentPage, $currentPage + 1, $lastPage];
        $visiblePages = [];

        foreach ($candidatePages as $candidatePage) {
            $isValidPage = $candidatePage >= 1 && $candidatePage <= $lastPage;
            $isAlreadyAdded = in_array($candidatePage, $visiblePages);

            if ($isValidPage && !$isAlreadyAdded) {
                $visiblePages[] = $candidatePage;
            }
        }

        sort($visiblePages);

        $previousPage = null;
    @endphp

    <div class="{{ $containerClass }}">
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded cursor-not-allowed">
                &lt;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                &lt;
            </a>
        @endif

        @foreach ($visiblePages as $page)
            @if ($previousPage && $page > $previousPage + 1)
                <span class="px-2 py-2 text-gray-500">...</span>
            @endif

            @if ($page == $currentPage)
                <span class="px-4 py-2 bg-green-600 text-white rounded">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $paginator->url($page) }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                    {{ $page }}
                </a>
            @endif

            @php
                $previousPage = $page;
            @endphp
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                &gt;
            </a>
        @else
            <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded cursor-not-allowed">
                &gt;
            </span>
        @endif
    </div>
@endif
