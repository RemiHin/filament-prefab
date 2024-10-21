<div class="md:flex justify-start items-center text-sm font-semibold text-brand-dark">
    @foreach($menu->children as $mainMenuItem)
        <ul class="list-none m-0 p-0">
            @if($mainMenuItem->menuable_type == null)
                <a href="{{ $mainMenuItem->getUrl() }}"
                   class="{{ $mainMenuItem->children->count() ? 'hidden' : 'flex' }} items-center px-5 py-2.5 bg-transparent text-gray-900 rounded-md mb-2 md:mb-0">
                    {{ $mainMenuItem->title }}
                </a>
            @elseif($mainMenuItem->children->count())
                <li class="relative border-b border-slate-200 lg:border-none">
                <span class="js-toggle-submenu flex lg:inline-flex items-center py-2 px-4 cursor-pointer underline underline-offset-4 decoration-2 decoration-transparent hover:decoration-current transition duration-150 ease-in-out text-brand-dark"
                      tabindex="0"
                      aria-expanded="false"
                      role="button">
                    {{ $mainMenuItem->title }}

                    <x-svg class="svg-icon relative inline-flex self-center h-5 w-5 ml-2"
                           src="assets/svg/chevron-down.svg"/>
                </span>

                    <x-menu.submenu :parent="$mainMenuItem"
                                    :items="$mainMenuItem->children"
                                    text-color="text-primary"
                                    class="js-submenu relative flex-col gap-1.5 pl-4 mb-2 lg:gap-3 lg:absolute lg:min-w-full lg:right-0 lg:bottom-0 lg:transform lg:translate-y-full lg:bg-white lg:rounded lg:shadow-md lg:p-4 lg:mb-0"/>
                </li>
            @else
                <a href="{{ $mainMenuItem->getUrl() }}"
                   class="{{ $mainMenuItem->children->count() ? 'hidden' : 'flex' }} items-center px-5 py-2.5 bg-transparent text-gray-900 rounded-md mb-2 md:mb-0">
                    {{ $mainMenuItem->title }}
                </a>
            @endif
        </ul>
    @endforeach
</div>
