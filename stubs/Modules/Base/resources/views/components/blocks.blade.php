@props([
    'blocks',
    'group' => 'active',
])

@if(is_countable($blocks) && count($blocks))
    @foreach($blocks as $block)
        <x-block :block="$block" :group="$group" />
    @endforeach
@endif
