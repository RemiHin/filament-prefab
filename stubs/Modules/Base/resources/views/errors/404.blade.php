<x-layouts.app>
    <section class="pt-5 lg:pt-10">
        <div class="container max-w-container-1/2">
            <h1 class="heading-2">
                {{ __('Page not found') }}
            </h1>

            <x-button
                href="/"
                class="btn-primary btn-reverse mt-5 z-10"
                :title="__('Back to home')"
                icon="arrow-left"
            />

            <img
                src="{{ asset('/assets/svg/illustrations/404-error.svg') }}"
                alt="{{ __('Page not found') }}"
                class="w-full -mt-10 max-h-[calc(100vh/2.5)]"
            />
        </div>
    </section>
</x-layouts.app>
