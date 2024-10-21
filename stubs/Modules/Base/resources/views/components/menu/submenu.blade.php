@props([
    'parent' => null,
    'items' => null,
    'textColor' => null,
])

<ul {{ $attributes->merge(['class' => 'list-none']) }}>
    @php /** @var \Motivo\Liberiser\Modules\Menu\Models\MenuItem $item */ @endphp

    @if($parent)
        <li>
            <a href="{{ $parent->url }}"
               class="flex py-1.5 underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if($parent->url === url()->current()) font-bold @else hover:decoration-current @endif"
               @if($parent->url === url()->current()) aria-current="page" @endif>
                {{ $parent->title }}
            </a>
        </li>
    @endif

    @forelse ($items as $item)
        <li>
            <a href="{{ $item->url }}"
               class="flex py-1.5 underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if($item->url === url()->current()) font-bold @else hover:decoration-current @endif"
               @if($item->url === url()->current()) aria-current="page" @endif>
                {{ $item->title }}
            </a>
        </li>
    @empty
    @endforelse
</ul>
