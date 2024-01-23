@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex flex-1 items-center justify-center">
            <div>
                <span class="relative z-0 inline-flex">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span
                            class="relative inline-flex items-center justify-center shrink-0 w-10 h-10 mr-5 text-secondary opacity-50 border-2 border-secondary rounded-full transition ease-in-out duration-150"
                            aria-hidden="true" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <x-svg
                                class="inline-flex shrink-0 w-6"
                                src="assets/svg/chevron-left"
                            />
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                           class="relative inline-flex items-center justify-center shrink-0 w-10 h-10 mr-5 text-secondary hover:text-white bg-white hover:bg-secondary-dark border-2 border-secondary hover:border-secondary-dark rounded-full transition ease-in-out duration-150"
                           aria-label="{{ __('pagination.previous') }}">

                            <x-svg
                                class="inline-flex shrink-0 w-6"
                                src="assets/svg/chevron-left"
                            />
                        </a>
                    @endif

                    <div class="flex items-center text-sm mr-2">
                        01
                    </div>

                    @foreach ($elements as $element)
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <div class="flex items-center">
                                        <span
                                            class="relative inline-block -ml-px text-sm bg-slate-200 h-1 w-5 focus:outline-none transition ease-in-out duration-150"
                                            aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        &nbsp;
                                    </span>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <a href="{{ $url }}"
                                           @class(['relative inline-block -ml-px text-sm h-1 w-5 focus:outline-none transition ease-in-out duration-150', 'bg-slate-200' => $page <= $paginator->currentPage(), 'bg-gray-100' => $page > $paginator->currentPage()])
                                           aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    </a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    <div class="flex items-center text-sm ml-2">
                        {{ $paginator->lastPage() < 10 ? '0'.$paginator->lastPage() : $paginator->lastPage() }}
                    </div>

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                           class="relative inline-flex items-center justify-center shrink-0 w-10 h-10 ml-5 text-secondary hover:text-white bg-white hover:bg-secondary-dark border-2 border-secondary hover:border-secondary-dark rounded-full transition ease-in-out duration-150"
                           aria-label="{{ __('pagination.next') }}">

                            <x-svg
                                class="inline-flex shrink-0 w-6"
                                src="assets/svg/chevron-right"
                            />
                        </a>
                    @else
                        <span
                            class="relative inline-flex items-center justify-center shrink-0 w-10 h-10 ml-5 text-secondary opacity-50 border-2 border-secondary rounded-full transition ease-in-out duration-150"
                            aria-hidden="true" aria-disabled="true" aria-label="{{ __('pagination.next') }}">

                            <x-svg
                                class="inline-flex shrink-0 w-6"
                                src="assets/svg/chevron-right"
                            />
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
