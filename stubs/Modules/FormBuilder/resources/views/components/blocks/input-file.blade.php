<div class="mb-6">
    <label for="{{ $block->id }}_file" class="text-lg font-bold text-gray-900">{{ $block->file }} @if($block->required) * @endif</label>

    @if($block->comment)
        <div class="mb-2 mt-2 text-gray-900">
            {!! nl2br($block->comment) !!}
        </div>
    @endif

    <input
        type="file"
        id="{{ $block->id }}_file"
        name="{{ $block->id }}[file]"
        value="{{ old($block->id . '.file') }}"
        class="w-full"
        @if($block->placeholder) placeholder="{{ $block->placeholder }}" @endif
        @if($block->required) required @endif
    >

    @php
        $maxFileSize = $block->max_file_size;
        $allowedMimeTypes = $block->allowed_mime_types;
    @endphp

    @if(!empty($maxFileSize) || !empty($allowedMimeTypes))
        <p class="mt-2 text-gray-900">
            @if(! empty($maxFileSize) && ! empty($allowedMimeTypes))
                {{ __('This field only accepts :types files with a max file size of :size kb.', ['types' => $allowedMimeTypes, 'size' => $maxFileSize]) }}
            @elseif(! empty($maxFileSize))
                {{ __('This field only accepts files with a max file size of :size kb.', ['size' => $maxFileSize]) }}
            @elseif(! empty($allowedMimeTypes))
                {{ __('This field only accepts :types files.', ['types' => $allowedMimeTypes]) }}
            @endif
        </p>
    @endif

    @error($block->id . '.file')
        <div class="text-red-700">{{ $message }}</div>
    @enderror
</div>
