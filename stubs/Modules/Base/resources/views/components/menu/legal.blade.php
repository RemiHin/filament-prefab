@props([
    'textColor' => null,
])
@if($menu)
<ul {{ $attributes->merge(['class' => 'list-none']) }}>
    @foreach($menu as $item)
        <li>
            <a
                class="inline-block underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if(url($item->path) === url()->current()) font-bold @else hover:decoration-current @endif"
                href="{{ url($item->path) }}"
                @if(url($item->path) === url()->current()) aria-current="page" @endif
            >
                {{ $item->name }}
            </a>
        </li>
    @endforeach
</ul>
@endif
