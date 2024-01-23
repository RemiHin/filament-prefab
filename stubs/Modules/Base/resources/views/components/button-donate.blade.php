@props([
    'href' => '/doneer',
    'title' => 'Doneer',
    'icon' => 'heart',
    'disabled' => false,
])

@php
    $classes = ['btn btn-donate btn-reverse leading-5'];

    if ($disabled) {
        $classes[] = 'opacity-60 pointer-events-none';
    }
@endphp

<a {{ $attributes->merge(['class' => implode(' ', $classes)]) }}
   @if($disabled)tabindex="-1" aria-disabled="true" @endif
   href="{{ $href }}">
    {!! $title !!}

    <x-svg
        class="svg-icon relative inline-flex self-center h-7 w-7 ml-2"
        src="assets/svg/{{ $icon }}"
    />
</a>
