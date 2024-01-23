@if ($paginator->hasPages())
    <nav
        role="navigation"
        aria-label="{{ __('Pagination Navigation') }}"
        class="flex items-center justify-between mt-2.5 lg:mt-5"
    >
        <div class="flex flex-1 items-center justify-center">
            <div class="relative z-0 flex items-center justify-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span
                        class="relative inline-flex items-center justify-center shrink-0 w-10 h-10 mr-5 text-secondary opacity-25 border-2 border-secondary rounded-full transition ease-in-out duration-150"
                        aria-hidden="true"
                        aria-disabled="true"
                        aria-label="{{ __('pagination.previous') }}"
                    >
                        <x-svg
                            class="inline-flex shrink-0 h-5 w-5"
                            src="assets/svg/chevron-left"
                        />
                    </span>
                @else
                    <a
                        href="{{ $paginator->previousPageUrl() }}"
                        rel="prev"
                        class="relative inline-flex items-center justify-center shrink-0 w-10 h-10 mr-5 text-secondary hover:text-white bg-white hover:bg-secondary border-2 border-secondary hover:border-secondary rounded-full transition ease-in-out duration-150"
                        aria-label="{{ __('pagination.previous') }}"
                    >
                        <x-svg
                            class="inline-flex shrink-0 h-5 w-5"
                            src="assets/svg/chevron-left"
                        />
                    </a>
                @endif

                <span>
                    {{ __(':count of :total', ['count' => $paginator->currentPage(), 'total' => $paginator->lastPage()]) }}
                </span>

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a
                        href="{{ $paginator->nextPageUrl() }}"
                        rel="next"
                        class="relative inline-flex items-center justify-center shrink-0 w-10 h-10 ml-5 text-secondary hover:text-white bg-white hover:bg-secondary border-2 border-secondary hover:border-secondary rounded-full transition ease-in-out duration-150"
                        aria-label="{{ __('pagination.next') }}"
                    >
                        <x-svg
                            class="inline-flex shrink-0 h-5 w-5"
                            src="assets/svg/chevron-right"
                        />
                    </a>
                @else
                    <span
                        class="relative inline-flex items-center justify-center shrink-0 w-10 h-10 ml-5 text-secondary opacity-25 border-2 border-secondary rounded-full transition ease-in-out duration-150"
                        aria-hidden="true" aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                    >
                        <x-svg
                            class="inline-flex shrink-0 h-5 w-5"
                            src="assets/svg/chevron-right"
                        />
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
