@props([
    'href',
    'title',
    'icon' => false,
    'target' => false,
])

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => 'link']) }}
    @if ($target) target="_blank" rel="noopener" title="{{ __('Opens in a new window') }}" @endif
>
    {{ $title }}

    @if ($target)
        <x-svg
            class="svg-icon relative h-4 w-4 ml-2 inline-flex self-center"
            src="assets/svg/external"
        />
    @elseif ($icon)
        <x-svg
            class="svg-icon relative h-4 w-4 ml-2 inline-flex self-center"
            src="assets/svg/{{ $icon }}"
        />
    @endif
</a>
