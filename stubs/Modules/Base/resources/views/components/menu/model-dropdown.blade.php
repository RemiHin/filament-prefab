@props([
    'models',
    'title' => null,
    'textColor' => null,
])

<li
    x-data="{ isMenuOpen: false, toggle() { this.isMenuOpen = ! this.isMenuOpen } }"
    class="list-none m-0 p-0"
>
    @if($models->count())
        <span
            @click="toggle()"
            class="relative border-b border-slate-200 lg:border-none"
        >
            <span
                x-bind:aria-expanded="isMenuOpen"
                class="flex lg:inline-flex items-center gap-2 py-2 px-5 font-family font-medium cursor-pointer transition duration-150 ease-in-out"
                tabindex="0"
                role="button"
            >
                {{ $title }}

                <x-svg
                    class="svg-icon relative inline-flex self-center h-4 w-4 transition duration-150 ease-in-out"
                    x-bind:class="{'rotate-180' : isMenuOpen}"
                    src="assets/svg/chevron-down.svg"
                />
            </span>

            <div
                x-show="isMenuOpen"
                x-cloak
                @keydown.window.escape="isMenuOpen = false"
                @click.outside="isMenuOpen = false"
                class="relative lg:fixed lg:bg-white lg:shadow-down-dark lg:min-w-full lg:right-0 lg:transform lg:translate-y-[10px]"
            >
                <div class="container max-w-container !p-0 lg:!px-5 lg:!py-8">
                        <ul class="list-none relative flex-col gap-1.5 pl-5 mb-2 lg:gap-x-3 lg:gap-y-0.5 lg:grid lg:grid-cols-3 lg:px-0 lg:mb-0">
                            @forelse($models as $model)
                                <li>
                                    <a
                                        href="{{ $model->getRoute() }}"
                                        class="flex py-1.5 font-family underline underline-offset-4 decoration-2 decoration-transparent lg:text-nowrap transition duration-150 ease-in-out @if($model->getRoute() === url()->current()) text-brand-green font-bold @else text-current font-medium hover:decoration-current @endif"
                                        @if($model->getRoute() === url()->current()) aria-current="page" @endif
                                    >
                                        {{ $model->getName() }}
                                    </a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </span>
    @endif
</li>
