<div class="mb-6">
    <label for="{{ $block->id }}_text" class="text-lg font-bold text-gray-900">{{ $block->title }} @if($block->required) * @endif</label>
    <textarea
        class="block w-full rounded border-gray-200"
        rows="5"
        id="{{ $block->id }}_text"
        name="{{ $block->id }}[text]"
        @if($block->placeholder) placeholder="{{ $block->placeholder }}" @endif
        required
    >{{ old($block->id . '.text') }}</textarea>
    @error($block->id . '.text')
        <div class="text-red-700">{{ $message }}</div>
    @enderror
</div>
