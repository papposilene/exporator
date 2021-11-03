@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-bluegray-500 bg-white border border-bluegray-300 cursor-default leading-5 rounded-md">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-bluegray-700 bg-white border border-bluegray-300 leading-5 rounded-md hover:text-bluegray-500 focus:outline-none focus:ring ring-bluegray-300 focus:border-sky-300 active:bg-bluegray-100 active:text-bluegray-700 transition ease-in-out duration-150">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-bluegray-700 bg-white border border-bluegray-300 leading-5 rounded-md hover:text-bluegray-500 focus:outline-none focus:ring ring-bluegray-300 focus:border-sky-300 active:bg-bluegray-100 active:text-bluegray-700 transition ease-in-out duration-150">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-bluegray-500 bg-white border border-bluegray-300 cursor-default leading-5 rounded-md">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
