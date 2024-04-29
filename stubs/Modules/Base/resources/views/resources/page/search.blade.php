<x-layouts.app>
    @section('seo')
        <x-seo
            :title="__('Search')"
        />
    @endsection

    @push('structured-data')
        <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "url": "{{ url()->current() }}",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ url('/zoeken?query={query}') }}",
            "query": "required"
        }
        }
        </script>
    @endpush

    @section('breadcrumbs')
        <x-content.breadcrumbs :backLink="url('/')" :backTitle="__('Back to home')">
            <x-content.breadcrumb :title="__('Search')"/>
        </x-content.breadcrumbs>
    @endsection

    <section class="py-5 lg:py-10">
        <div class="container max-w-container-1/2">
            <h1 class="heading-2 text-center">
                {{ __('Search') }}
            </h1>
        </div>

        <div class="container max-w-container-1/2">
            <form
                method="get"
                class="mt-5"
            >
                <div class="form-input-group form-input-group-search">
                    <label
                        for="global-page-search"
                        class="absolute opacity-0 pointer-events-none"
                    >
                        Zoeken
                    </label>
                    <div class="relative flex flex-row flex-nowrap">
                        <input
                            type="text"
                            name="query"
                            id="global-page-search"
                            class="w-full h-12 px-5"
                            placeholder="{{ __('Search') }}..."
                            value="{{ request()->input('query') }}"
                        >
                        <button
                            class="absolute top-0 right-0 flex justify-center items-center h-12 w-12 rounded-full bg-transparent text-primary"
                            aria-label="{{ __('Search') }}"
                        >
                            <x-svg
                                class="svg-icon relative inline-flex self-center h-5 w-5"
                                src="assets/svg/search"
                            />
                        </button>
                    </div>
                </div>
            </form>

            @if(! is_null($results))
                <div class="mt-5">
                    @if($results->count() > 1)
                        <p>{{ __(':count results were found on your search request :searchterm', ['count' => $results->count(), 'searchterm' => request()->input('query') ]) }}</p>
                    @elseif($results->count() == 0)
                        <p>{{ __('No results were found on your search request :searchterm', ['searchterm' => request()->input('query') ]) }}</p>
                    @else
                        <p>{{ __(':count result has been found on your search request :searchterm', ['count' => $results->count(), 'searchterm' => request()->input('query') ]) }}</p>
                    @endif
                </div>

                @if($results->count())
                    <ul class="list-none mt-10 pl-0 flex flex-wrap border-t border-slate-300">
                        @foreach($results as $result)
                            <li class="relative flex flex-col-reverse group w-full flex-shrink-0 bg-white border-b border-slate-300 pt-5 pb-10">
                                <a
                                    href="{{ $result['slug'] }}"
                                    class="heading-6 flex self-start full-click group-hover:underline"
                                >
                                    {{ $result['title'] }}
                                </a>
                                <div class="label mb-2 inline-flex self-start">
                                    {{ $result['type'] }}
                                </div>

                                <x-svg
                                    class="svg-icon absolute inline-flex self-center text-secondary h-6 w-6 right-0 bottom-2"
                                    src="assets/svg/chevron-right.svg"
                                />
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="flex justify-center w-full py-10">
                        <img
                            src="{{ asset('/assets/svg/illustrations/no-results.svg') }}"
                            alt="{{ __('No results') }}"
                            class="w-full max-w-[225px]"
                        />
                    </div>
                @endif
            @endif
        </div>
    </section>
</x-layouts.app>
