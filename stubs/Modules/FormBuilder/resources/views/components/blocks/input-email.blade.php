<div class="mb-6">
    <label for="{{ $block->id }}_email" class="text-lg font-bold text-gray-900">{{ $block->title }} @if($block->required) * @endif</label>
    <input
        type="email"
        id="{{ $block->id }}_email"
        name="{{ $block->id }}[email]"
        value="{{ old($block->id . '.email') }}"
        @if($block->placeholder) placeholder="{{ $block->placeholder }}" @endif
        @if($block->required) required @endif
    >
    @error($block->id . '.email')
        <div class="text-red-700">{{ $message }}</div>
    @enderror
</div>
