@props([
    'href' => null,
    'title',
    'icon' => false,
    'disabled' => false,
    'buttonType' => 'button',
    'value' => null,
])

@php
    $classes = ['btn leading-5'];

    if ($disabled) {
        $classes[] = 'opacity-60 pointer-events-none';
    }
@endphp

@if ($href)
    <a {{ $attributes->merge(['class' => implode(' ', $classes)]) }}
       @if($disabled)tabindex="-1" aria-disabled="true" @endif
       href="{{ $href }}">
        {!! $title !!}

        @if($icon)
            <x-svg
                class="svg-icon relative inline-flex self-center h-5 w-5 ml-2"
                src="assets/svg/{{ $icon }}"
            />
        @endif
    </a>
@else
    <button {{ $attributes->merge(['class' => implode(' ', $classes)]) }}
            @if($disabled)tabindex="-1"@endif
            type="{{ $buttonType }}" @if($value) value="{{ $value }}" @endif>
        {!! $title !!}

        @if($icon)
            <x-svg
                class="svg-icon relative inline-flex self-center h-5 w-5 ml-2"
                src="assets/svg/{{ $icon }}"
            />
        @endif
    </button>
@endif
