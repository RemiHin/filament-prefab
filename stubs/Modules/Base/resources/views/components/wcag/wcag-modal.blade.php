<section
    class="js-wcag-modal fixed top-0 right-0 flex-grow w-full h-full z-40"
    role="dialog"
    aria-modal="false"
>
    <div class="flex flex-row h-full w-full bg-slate-700/25">
        <div class="js-toggle-wcag-modal flex flex-shrink-1 h-full w-full"></div>

        <div class="wcag-modal-content flex flex-col flex-shrink-0 h-full w-full overflow-y-auto pt-2 pb-8 px-5 max-w-[705px] bg-white">
            <div class="js-loop-tab-wcag-modal" tabindex="0"></div>

            <x-button
                class="js-toggle-wcag-modal js-close-wcag-modal btn btn-secondary btn-small inline-flex self-end"
                title="{{ __('Close') }}"
                aria-label="{{ __('Close accessibility menu') }}"
                icon="close"
            />

            <div class="flex flex-row flex-nowrap mt-5">
                <x-svg
                    class="inline-flex w-5 sm:w-6 lg:w-8 mr-2 lg:mr-4 flex-shrink-0"
                    src="assets/svg/accessibility-icon"
                />
                <h2 class="heading-3 overflow-hidden break-words">
                    {{ __('Accessibility') }}
                </h2>
            </div>

            <ul class="list-none pl-0 flex flex-col gap-10 h-auto mt-5 lg:mt-10">
                <x-wcag.contrast-options />
                <x-wcag.fontsize-options />
            </ul>
            <div class="js-loop-tab-wcag-modal" tabindex="0"></div>
        </div>
    </div>
</section>
