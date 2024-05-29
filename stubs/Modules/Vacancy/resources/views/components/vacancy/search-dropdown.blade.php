@props([
    'title',
    'icon',
    'modelAttribute' => null,
    'livewireModel' => null,
    'models' => null,
    'open' => false,
])

<div x-data="{open: @if ($open) true @else false @endif}" x-cloak>
    <fieldset class="relative">
        <div
            class="relative flex items-center text-lg font-bold cursor-pointer py-1.5 pl-2 pr-10 rounded bg-transparent hover:bg-white transition duration-150 ease-in-out"
            @click="open = !open"
            @keyup.enter="open = !open"
            tabindex="0"
            role="button"
            aria-expanded="@if ($open) true @else false @endif"
        >
            <x-svg
                class="svg-icon inline-flex self-center h-6 w-6 text-secondary mr-3"
                src="assets/svg/{{ $icon }}"
            />

            <legend>
                {{ $title }}
            </legend>

            <div
                class="absolute right-3 top-1/2 transform -translate-y-1/2 inline-flex justify-center items-center h-5 w-5 transition duration-150 ease-in-out"
                :class="{ 'rotate-180': open, 'rotate-0': !open }"
            >
                <x-svg
                    class=" svg-icon inline-flex h-5 w-5 text-secondary"
                    src="assets/svg/chevron-down"
                />
            </div>
        </div>

        <div x-show="open" class="mt-1 pl-10 pr-2">
            @if($slot->isNotEmpty())
                {{ $slot }}
            @else
                <ul class="list-none pl-0 mt-2">
                    @forelse($models as $position)
                        <li class="relative w-full inline-flex py-1.5">
                            <input
                                type="checkbox"
                                id="{{ $livewireModel }}-{{ $position->id }}"
                                class="rounded h-5 w-5 border-slate-200"
                                value="{{ $position->id }}"
                                wire:model.live="{{ $livewireModel }}"
                            >
                            <label
                                for="{{ $livewireModel }}-{{ $position->id }}"
                                aria-label="{{ $title }} {{ $position->$modelAttribute }}"
                            >
                                <span class="ml-3">{{ $position->$modelAttribute }}</span>
                            </label>
                        </li>
                    @empty
                        <div class="text-slate-600 italic">
                            {{ __('No results') }}
                        </div>
                    @endforelse
                </ul>
            @endif
        </div>
    </fieldset>
</div>
