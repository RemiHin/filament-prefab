<div x-data="{ open: '' }" class="md:flex justify-start items-center text-sm font-semibold text-brand-dark">
    @foreach($menu->children as $mainMenuItem)
        <div class="relative w-full">
            @if($mainMenuItem->children->count() || $mainMenuItem->menuable_type == 'Empty')
                <button type="button"
                        @click="open == '{{ $mainMenuItem->id }}' ? open = '' : open = '{{ $mainMenuItem->id }}'"
                        class="w-full items-center gap-2 px-5 py-2.5 {{ $mainMenuItem->children->count() ? 'flex justify-between' : 'hidden' }}">
                    {{ $mainMenuItem->title }}
                    @if($mainMenuItem->children->count())
                        <x-svg class="svg-icon relative inline-flex self-center h-5 w-5 ml-2"
                               src="assets/svg/chevron-down.svg"
                               x-bind:class="open == '{{ $mainMenuItem->id }}' ? 'rotate-180' : ''"/>
                    @endif
                </button>
            @endif

            @if($mainMenuItem->menuable_type != 'Empty')

                <a href="{{ $mainMenuItem->menuable->url }}"
                   class="{{ $mainMenuItem->children->count() ? 'hidden' : 'flex' }} items-center gap-2 px-5 py-2.5 bg-transparent text-gray-900 rounded-md mb-2 md:mb-0">
                    {{ $mainMenuItem->title }}
                </a>
            @endif
            @if($mainMenuItem->children->count())
                <div
                        x-cloak
                        x-collapse
                        x-show="open == '{{ $mainMenuItem->id }}'"
                        class="ml-5 flex-1 rounded-md border border-gray-200 z-50"
                >
                    @if($mainMenuItem->menuable_type != 'Empty')
                        <a href="{{ $mainMenuItem->menuable->url }}"
                           class="bg-white block w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-tint disabled:text-gray-500">
                            {{ $mainMenuItem->title }}
                        </a>
                    @endif
                    @foreach($mainMenuItem->children as $subMenuItem)
                        <a href="{{ $subMenuItem->menuable->url }}"
                           class="block w-full bg-white mb-0 text-gray-900 first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-tint disabled:text-gray-500">
                            {{ $subMenuItem->title }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>
