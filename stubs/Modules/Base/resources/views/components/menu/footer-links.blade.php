@props([
    'textColor' => null,
])

@if($menuItems->count())
<ul {{ $attributes->merge(['class' => 'list-none']) }}>
    @foreach($menuItems as $item)
        @if($item->children->count())
            <li>
                <span class="flex w-full py-2 border-t border-slate-200 md:border-none font-bold {{ $textColor }}">
                    {{ $item->name }}
                </span>

                <x-menu.submenu
                    :parent="$item"
                    :items="$item->children"
                    text-color="text-primary"
                    class="relative w-full flex flex-col mb-2 md:mb-0 gap-0.5 lg:gap-1 px-0"
                />
            </li>
        @else
            <li class="relative">
                <a
                    class="flex w-full py-2 border-t border-slate-200 md:border-none underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if($item->getUrl() === url()->current()) font-bold @else hover:decoration-current @endif"
                    href="{{ $item->getUrl() }}"
                    @if($item->getUrl() === url()->current()) aria-current="page" @endif
                >
                    {{ $item->name }}
                </a>
            </li>
        @endif
    @endforeach
</ul>
@endif
