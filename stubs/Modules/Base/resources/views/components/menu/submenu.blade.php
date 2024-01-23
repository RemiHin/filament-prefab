@props([
    'parent' => null,
    'items' => null,
    'textColor' => null,
])

<ul {{ $attributes->merge(['class' => 'list-none']) }}>
    @php /** @var \Motivo\Liberiser\Modules\Menu\Models\MenuItem $item */ @endphp

    @if($parent)
        <li>
            <a
                href="{{ url($parent->path) }}"
                class="flex py-1.5 underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if(url($parent->path) === url()->current()) font-bold @else hover:decoration-current @endif"
                @if(url($parent->path) === url()->current()) aria-current="page" @endif
            >
                {{ $parent->name }}
            </a>
        </li>
    @endif

    @forelse ($items as $item)
        <li>
            <a
                href="{{ url($item->path) }}"
                class="flex py-1.5 underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if(url($item->path) === url()->current()) font-bold @else hover:decoration-current @endif"
                @if(url($item->path) === url()->current()) aria-current="page" @endif
            >
                {{ $item->name }}
            </a>
        </li>
    @empty
    @endforelse
</ul>
