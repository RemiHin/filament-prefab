<div class="md:flex justify-start items-center text-sm font-semibold text-brand-dark">
    @foreach($menu->children as $mainMenuItem)
        <div class="relative group">
            @if($mainMenuItem->children->count() || $mainMenuItem->menuable_type == 'Empty')
                <button type="button"
                        class="flex items-center gap-2 px-5 py-2.5">
                    {{ $mainMenuItem->title }}
                    @if($mainMenuItem->children->count())
{{--                    todo: chrevron down    <x-svgs.chevron-down class="hidden md:block h-5 w-5 text-gray-400"/>--}}
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
                    class="absolute group-hover:block hidden md:left-0 pl-0 min-w-40 rounded-md md:shadow md:divide-y divide-gray-100 z-50"
                >
                    @if($mainMenuItem->menuable_type != 'Empty')

                        <a href="{{ $mainMenuItem->menuable->url }}"
                           class="hidden bg-white md:block w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm md:hover:bg-tint disabled:text-gray-500">
                            {{ $mainMenuItem->title }}
                        </a>
                    @endif
                    @foreach($mainMenuItem->children as $subMenuItem)
                        <a href="{{ $subMenuItem->menuable->url }}"
                           class="block w-full bg-white mb-2 md:mb-0 text-gray-900 rounded-md rounded-none first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-tint disabled:text-gray-500">
                            {{ $subMenuItem->title }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>
