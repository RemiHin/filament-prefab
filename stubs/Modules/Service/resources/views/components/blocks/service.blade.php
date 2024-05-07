@php
$service = $block->getService();
@endphp

@if($service)
    <section class="{{ $type }} flex flex-col w-full max-w-[900px] px-5 mx-auto my-10 lg:my-12">
        <article class="relative h-full flex flex-col-reverse sm:flex-row-reverse group justify-end items-center transition duration-150 ease-in-out">
            <div class="absolute h-full w-full sm:w-[calc(100%-155px)] top-0 right-0 bg-secondary-light rounded-2xl"></div>
            <div class="relative w-full h-full flex flex-col gap-5 p-5 pt-8 sm:p-10 sm:pl-10 md:pl-14">
                <div class="flex flex-col-reverse grow justify-center gap-1">
                    <div class="flex flex-col gap-3">
                        <h2 class="text-4xl">
                            {{ $service->name }}
                        </h2>

                        @if (! empty($service->intro))
                            <p class="editor hidden sm:flex flex-col">
                                {!! $service->intro !!}
                            </p>
                        @endif
                    </div>
                </div>

                <x-button
                        href="{{ $service->url }}"
                        class="btn-yellow animate-right self-start"
                        title="{{ __('Read the full service') }}"
                        icon="chevron-right"
                />
            </div>

            @if (! empty($service->image))
                <div class="w-[calc(100%+30px)] -ml-2.5 sm:ml-0 sm:w-full">
                    <x-curator-glider :media="$service->image" />
                </div>
            @endif
        </article>
    </section>
@endif
