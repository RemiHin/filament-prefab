@props([
    'title',
    'href' => null,
])

<li class="list-none flex gap-2.5 items-center">
    @if ($href)
        <a
            href="{{ $href }}"
            class="underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out @if($href) text-slate-500 hover:text-secondary hover:decoration-current @else text-primary @endif"
        >
    @endif

    {{ $title }}

    @if ($href)
        </a>
    @endif

    <x-svg
        src="assets/svg/chevron-right"
        class="chevron-icon w-5"
    />
</li>
