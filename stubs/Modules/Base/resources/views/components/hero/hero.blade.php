@props([
    'title',
    'text',
    'img',
    'alt',
    'date',
    'primaryBtnText',
    'primaryBtnLink',
    'secondaryBtnText',
    'secondaryBtnLink',
])

<section {{ $attributes->merge(['class' => 'w-full']) }}>
    <div class="w-full flex flex-row flex-col-reverse lg:flex-row lg:gap-5 bg-slate-100">
        <div class="w-full lg:w-1/2 p-5 lg:py-10 flex flex-col justify-center">
            <div class="w-full max-w-container-1/2 mx-auto flex flex-col gap-5">
                <h1 class="heading-1">
                    {{ $title }}
                </h1>

                @if (! empty($text))
                    {!! $text !!}
                @endif

                @if (! empty($date))
                    <p>{{ $date }}</p>
                @endif

                <div class="flex flex-row flex-wrap items-center gap-x-10 gap-y-5">
                    @if (! empty($primaryBtnText) || ! empty($primaryBtnLink))
                        <x-button
                            :href="$primaryBtnLink"
                            :title="$primaryBtnText"
                            class="btn-primary"
                        />
                    @endif

                    @if (! empty($secondaryBtnText) || ! empty($secondaryBtnLink))
                        <x-link
                            :href="$secondaryBtnLink"
                            :title="$secondaryBtnText"
                        />
                    @endif
                </div>
            </div>
        </div>

        @if (! empty($img))
            <div class="w-full lg:w-1/2">
                <div class="h-full w-full lg:p-5">
                    <figure class="relative overflow-hidden h-full w-full pb-[65%] lg:rounded-lg bg-slate-200">
                        <img
                            class="absolute h-full w-full object-cover"
                            src="{{ $img }}"
                            alt="{{ $alt ?? '' }}"
                            loading="lazy"
                        >
                    </figure>
                </div>
            </div>
        @endif
    </div>
</section>
