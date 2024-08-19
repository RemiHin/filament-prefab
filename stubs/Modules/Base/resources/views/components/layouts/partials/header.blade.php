@props([
    'stripped' => false,
])

<header {{ $attributes->merge(['class' => 'sticky w-full flex flex-col bg-white z-30 top-0 shadow-lg z-20']) }}>
    <a class="skip-link -bottom-5 left-5 transform translate-y-full" href="#main-content">
        {{ __('Skip menu') }}
    </a>

    <div class="flex flex-row justify-end items-center text-sm lg:py-2 lg:px-5 bg-default-accent">
        @if(! $stripped)
            <nav class="hidden lg:flex">
                <x-menu.top
                    text-color="text-primary-dark"
                    class="flex flex-row items-center"
                />
            </nav>
        @endif

        <x-button
            class="js-wcag-menu-button js-toggle-wcag-modal btn btn-secondary btn-small btn-reverse w-full lg:w-auto rounded-none lg:rounded justify-center"
            title="{{ __('Accessibility') }}"
            aria-label="{{ __('Open accessibility menu') }}"
            icon="accessibility-icon"
        />
    </div>

    <div class="flex flex-row items-center justify-between py-2 px-5">
        <a href="/" aria-label="{{ __('Home') }} {{ config('app.name') }}">
            <img src="{{ asset('assets/logo.svg') }}" class="h-12" alt="">
        </a>

        @if(! $stripped)
            <nav class="hidden lg:flex gap-4">
                <x-menu.main
                    text-color="text-primary-dark"
                    class="flex flex-row items-center gap-2 pl-0"
                />
            </nav>
        @endif

        <div class="mobile-menu flex flex-row flex-nowrap gap-4 items-center lg:hidden">
            <x-button
                class="js-toggle-mobile-menu js-mobile-menu-button btn btn-primary btn-small"
                title="{{ __('Menu') }}"
                aria-label="{{ __('Open menu') }}"
                icon="hamburger-menu"
                aria-expanded="false"
            />
        </div>
    </div>

    <section
        class="js-mobile-menu fixed top-0 right-0 h-full w-full lg:hidden"
        role="dialog"
        aria-modal="false"
    >
        <div class="flex flex-row h-full w-full bg-slate-700/25">
            <div class="js-toggle-mobile-menu flex flex-shrink-1 h-full w-full"></div>

            <div class="mobile-menu-sidebar flex flex-col flex-shrink-0 h-full w-full overflow-y-auto pt-2 pb-8 px-5 max-w-[380px] bg-white">
                <div class="js-loop-mobile-menu" tabindex="0"></div>

                <x-button
                    class="js-toggle-mobile-menu js-close-mobile-menu btn btn-secondary btn-small inline-flex self-end"
                    title="{{ __('Close') }}"
                    aria-label="{{ __('Close menu') }}"
                    icon="close"
                />

                <div class="flex flex-col flex-grow justify-between gap-5 mt-5">
                    <nav class="flex flex-col">
                        <h2 class="heading-3">
                            {{ __('Menu') }}
                        </h2>

                        <x-menu.main
                            text-color="text-primary-dark"
                            class="flex flex-col pl-0 mt-3"
                        />
                    </nav>
                    <nav class="flex text-sm">
                        <x-menu.top
                            text-color="text-secondary-dark"
                            class="flex flex-col pl-0 border-l border-slate-200"
                        />
                    </nav>
                </div>

                <div class="js-loop-mobile-menu" tabindex="0"></div>
            </div>
        </div>
    </section>
</header>
