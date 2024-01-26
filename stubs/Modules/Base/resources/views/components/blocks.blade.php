@props([
    'blocks',
])

@if(is_countable($blocks) && count($blocks))
    @foreach($blocks as $block)
        <x-block :block="$block" />
    @endforeach
@endif
