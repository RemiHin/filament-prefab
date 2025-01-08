@props([
    'textColor' => null,
])

@if($menuItems->count())
<ul {{ $attributes->merge(['class' => 'list-none']) }}>
    @foreach($menuItems as $menuItem)
        <li>
            <a
                class="inline-block underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if($menuItem->getUrl() === url()->current()) font-bold @else hover:decoration-current @endif"
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
    @endforeach
</ul>
@endif
