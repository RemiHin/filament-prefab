<div class="mb-6">
    <label for="{{ $block->id }}_text" class="text-lg font-bold text-gray-900">{{ $block->title }} @if($block->required) * @endif</label>
    <input
        type="text"
        id="{{ $block->id }}_text"
        name="{{ $block->id }}[text]"
        value="{{ old($block->id . '.text') }}"
        @if($block->placeholder) placeholder="{{ $block->placeholder }}" @endif
        @if($block->required) required @endif
    >
    @error($block->id . '.text')
        <div class="text-red-700">{{ $message }}</div>
    @enderror
</div>
