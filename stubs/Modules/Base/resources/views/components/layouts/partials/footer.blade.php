@props([
    'stripped' => false,
])

<footer {{ $attributes->merge(['class' => 'relative flex-col flex-shrink-0 bg-white border-t-2 border-slate-100']) }}>
    @if(! $stripped)
        <div class="container max-w-container flex pt-10 pb-5 md:pb-10">
            <div class="w-full flex flex-col md:flex-row items-start gap-5 md:gap-8 lg:gap-12">
                <div class="flex flex-col gap-5 flex-shrink-0 self-center md:self-start">
                    <img
                        src="{{ asset('assets/logo.svg') }}"
                        alt="Logo {{ config('app.name') }}"
                        class="w-full max-w-[180px]"
                    >

                    <ul class="list-none pl-0 flex flex-col gap-2.5 self-start">
                        @if(config('contact.phone'))
                            <li class="flex">
                                <a
                                    href="tel:{{ config('contact.phone') }}"
                                    target="_blank"
                                    class="flex flex-row-reverse items-center self-end gap-2.5 underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out hover:decoration-current"
                                >
                                    {{ config('contact.phone') }}

                                    <x-svg
                                        class="svg-icon relative inline-flex self-center h-5 w-5"
                                        src="assets/svg/phone"
                                    />
                                </a>
                            </li>
                        @endif

                        @if(config('contact.email'))
                            <li class="flex">
                                <a
                                    href="mailto:{{ config('contact.email') }}"
                                    target="_blank"
                                    class="flex flex-row-reverse items-center self-end gap-2.5 underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out hover:decoration-current"
                                >
                                    {{ config('contact.email') }}

                                    <x-svg
                                        class="svg-icon relative inline-flex self-center h-5 w-5"
                                        src="assets/svg/mail"
                                    />
                                </a>
                            </li>
                        @endif
                    </ul>

                    <x-content.socials />
                </div>

                <div class="flex w-full">
                    <x-menu.footer-links
                        text-color="text-primary-dark"
                        class="pl-0 w-full flex flex-col md:flex-row flex-wrap md:gap-8 lg:gap-12"
                    />
                </div>
            </div>
        </div>
    @else
        <div class="container flex flex-col items-center text-center pt-10 pb-5">
            <img
                src="{{ asset('assets/logo.svg') }}"
                alt="Logo {{ config('app.name') }}"
                class="w-full max-w-[180px]"
            >
        </div>
    @endif

    <div class="w-full bg-default-accent">
        <div class="container max-w-container flex flex-col-reverse md:flex-row md:items-center md:justify-center gap-4 py-5">
            <span class="font-semibold text-sm">
                &copy; {{ __('Copyright') }} {{ \Carbon\Carbon::today()->format('Y') }} {{ config('app.name') }}
            </span>

            <x-menu.legal
                text-color="text-primary"
                class="flex flex-col md:flex-row md:items-center flex-wrap gap-4 pl-0 text-sm"
            />
        </div>
    </div>
</footer>
