@props([
    'textColor' => null,
])

@if($menuItems->count())
<ul {{ $attributes->merge(['class' => 'list-none']) }}>
    @foreach($menuItems as $menuItem)
        @if($menuItem->children->count())
            <li>
                <span class="flex w-full py-2 border-t border-slate-200 md:border-none font-bold {{ $textColor }}">
                    {{ $menuItem->title }}
                </span>

                <x-menu.submenu
                    :parent="$menuItem"
                    :items="$menuItem->children"
                    text-color="text-primary"
                    class="relative w-full flex flex-col mb-2 md:mb-0 gap-0.5 lg:gap-1 px-0"
                />
            </li>
        @else
            <li class="relative">
                <a
                    class="flex w-full py-2 border-t border-slate-200 md:border-none underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if($menuItem->getUrl() === url()->current()) font-bold @else hover:decoration-current @endif"
                    href="{{ $menuItem->getUrl() }}"
                    @if($menuItem->getUrl() === url()->current()) aria-current="page" @endif
                    @if(is_external_url($menuItem->getUrl())) target="_blank" rel="noopener" @endif
                >
                    {{ $menuItem->title }}

                    @if(is_external_url($menuItem->getUrl()))
                        <x-svg
                            class="svg-icon relative inline-flex self-center h-6 w-6 ml-2"
                            src="assets/svg/external-link.svg"
                        />
                    @endif
                </a>
            </li>
        @endif
    @endforeach
</ul>
@endif
