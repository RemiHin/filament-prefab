@props([
    'name' => null,
    'value' => null,
    'model' => null,
])

<li class="relative inline-flex whitespace-nowrap gap-2 items-center text-sm text-secondary border border-secondary rounded px-2 py-1 cursor-pointer" {{ $attributes }}>
    @if($slot->isNotEmpty())
        {{ $slot }}
    @else
        {{ $name }}

        <label
            class="w-full gap-2 inline-flex items-center"
            for="{{ $model }}-filter-{{ $value }}"
            aria-label="{{ __('Remove') }} {{ __('filter') }} {{ $name }}"
        >
            <input
                type="checkbox"
                id="{{ $model }}-filter-{{ $value }}"
                class="absolute h-full w-full h-full rounded top-0 left-0 full-checkbox-focus"
                value="{{ $value }}"
                wire:model.live="{{ $model }}"
                tabindex="0"
                role="button"
            >

            <x-svg
                class="svg-icon inline-flex self-center h-5 w-5 text-secondary cursor-pointer"
                src="assets/svg/close"
            />
        </label>
    @endif
</li>
