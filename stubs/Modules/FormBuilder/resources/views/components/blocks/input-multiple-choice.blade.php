<div class="mb-6">
    <label for="{{ $block->id }}_value" class="text-lg font-bold text-gray-900">{{ $block->title }} @if($block->required) * @endif</label>

    <div x-data="{ value: '{{ old($block->id . '.value') }}', freeInput: {{ $block->freeInputJsArray() }} }">
        @foreach($block->options as $option)
            <label class="block">
                <input type="radio" name="{{ $block->id }}[value]" id="{{ $block->id }}_value" value="{{ $option['id'] }}" x-model="value">
                <span class="ml-1">
                    {{ $option['title'] }}
                </span>
            </label>

        @endforeach

        <div
            x-show="freeInput.includes(value)"
            class="mt-4 p-0 border-none"
        >
            <label class="screen-reader" for="{{ $block->id }}_other">
                Aanvullende tekst voor {{ $option['title'] }}
            </label>
            <input
                id="{{ $block->id }}_other"
                type="text"
                name="{{ $block->id }}[other]"
                value="{{ old($block->id . '.other') }}"
            >
        </div>
    </div>

    @error($block->id . '.value')
    <div class="text-red-700">{{ $message }}</div>
    @enderror
</div>
