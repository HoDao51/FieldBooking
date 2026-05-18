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
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor"
                        d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64" />
                </svg>

            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-green-500 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor"
                        d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64" />
                </svg>

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
                <svg xmlns="http://www.w3.org/2000/svg" width="1.1em" height="1.2em" viewBox="0 0 23 24">
                    <path d="M0 0h12v24H0z" fill="none" />
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M10.157 12.711L4.5 18.368l-1.414-1.414l4.95-4.95l-4.95-4.95L4.5 5.64l5.657 5.657a1 1 0 0 1 0 1.414" />
                </svg>
            </a>
        @else
            <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 23 24">
                    <path d="M0 0h12v24H0z" fill="none" />
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M10.157 12.711L4.5 18.368l-1.414-1.414l4.95-4.95l-4.95-4.95L4.5 5.64l5.657 5.657a1 1 0 0 1 0 1.414" />
                </svg>

            </span>
        @endif
    </div>
@endif
