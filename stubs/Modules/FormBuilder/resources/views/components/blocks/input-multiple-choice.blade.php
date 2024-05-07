<div class="mb-6">
    <label for="{{ $block->id }}_options" class="text-lg font-bold text-gray-900">{{ $block->title }} @if($block->required) * @endif</label>

    <div class="form-flex-row-wrap form-gap multiple-choice-group">
        <ul>
            @foreach($block->options as $option)
                @php
                    $selected = false;
                    $old = old($block->id, []);

                    if (array_key_exists('options', $old) && in_array($option['id'], $old['options'])) {
                        $selected = true;
                    }
                @endphp
                <li x-data="{ show: {{ $selected ? 'true' : 'false' }}, freeInput: {{ $option['free_input'] }} }" x-cloak="">
                    <label>
                        <input
                            type="checkbox"
                            name="{{ $block->id }}[options][]"
                            value="{{ $option['id'] }}"
                            x-model="show"
                            @if($selected) checked @endif
                        >
                        <span>
                        {{ $option['title'] }}
                    </span>
                    </label>

                    <div
                        x-show="freeInput && show"
                    >
                        <label class="screen-reader" for="{{ $block->id }}_other">
                            Aanvullende tekst voor {{ $option['title'] }}
                        </label>
                        <input
                            id="{{ $block->id }}_{{ $option['id'] }}_other"
                            type="text"
                            name="{{ $block->id }}[other][{{ $option['id'] }}]"
                            value="{{ old($block->id . '.other.' . $option['id']) }}"
                            class="compact"
                        >
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    @error($block->id . '.options')
    <div class="text-red-700">{{ $message }}</div>
    @enderror
</div>
