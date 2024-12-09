@props([
    'textColor' => null,
])

@if($menuItems->count())
<ul {{ $attributes->merge(['class' => 'list-none']) }}>
    @foreach($menuItems as $item)
        <li>
            <a
                class="inline-block underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if($item->getUrl() === url()->current()) font-bold @else hover:decoration-current @endif"
                href="{{ $item->getUrl() }}"
                @if($item->getUrl() === url()->current()) aria-current="page" @endif
            >
                {{ $item->name }}
            </a>
        </li>
    @endforeach
</ul>
@endif
