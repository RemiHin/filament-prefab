@props ([
    'href' => null,
    'img',
    'alt' => null,
    'label',
    'date',
    'title',
    'text',
    'heading' => false,
    'landscape' => false,
])

@php
    $classes = ['relative h-full rounded bg-white flex group shadow-xl overflow-hidden justify-end transition-colors duration-150 ease-in-out'];

    if ($landscape) {
        $classes[] = 'flex-row-reverse';
    } else {
        $classes[] = 'flex-col-reverse';
    }
@endphp

<article {{ $attributes->merge(['class' => implode(' ', $classes)]) }}>
    <div class="w-full h-full flex flex-col gap-5 @if($landscape) py-5 pr-5 @else px-5 pb-5 @endif">
        <div class="flex flex-col-reverse grow justify-end gap-3">
            <div class="flex flex-col gap-3">
                @if ($heading) <h{{ $heading }}> @endif
                    @if($href)
                        <a href="{{ $href }}" class="heading-4 text-default-color flex full-click group-hover:text-default-color transition-colors duration-150 ease-in-out">
                            {!! $title !!}
                        </a>
                    @else
                        <div class="heading-4 text-default-color flex full-click group-hover:text-default-color transition-colors duration-150 ease-in-out">
                            {!! $title !!}
                        </div>
                    @endif
                @if ($heading) </h{{ $heading }}> @endif

                @if (! empty($text))
                    <p class="flex flex-col">
                        {!! Str::limit($text, 120) !!}
                    </p>
                @endif
            </div>

            @if (! empty($label) || ! empty($date))
                <div class="flex flex-row flex-wrap gap-3 items-center">
                    @if (! empty($label))
                        <div class="label">{{ $label }}</div>
                    @endif
                    @if (! empty($date))
                        <div class="text-sm text-gray-600">{{ $date }}</div>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <div
                class="flex flex-row items-center text-primary"
                aria-hidden="true"
            >
                {{ __('Read more') }}

                <x-svg
                    class="svg-icon relative inline-flex self-center h-5 w-5 ml-2"
                    src="assets/svg/arrow-right.svg"
                />
            </div>
        </div>
    </div>

    @if (! empty($img))
        <div class="w-full p-5">
            <figure class="relative overflow-hidden w-full h-full rounded @if($landscape) pb-[100%] @else pb-[66%] @endif bg-slate-200">
                <img
                    class="absolute h-full w-full object-cover"
                    src="{{ $img }}"
                    alt="{{ $alt }}"
                    loading="lazy"
                >
            </figure>
        </div>
    @endif
</article>
