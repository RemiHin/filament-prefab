<li class="flex flex-col">
    <div class="flex flex-row flex-nowrap">
        <x-svg
            class="inline-flex w-5 mr-2 lg:mr-4 flex-shrink-0 text-secondary"
            src="assets/svg/contrast"
        />
        <h3 class="text-lg">
            {{ __('Contrast') }}
        </h3>
    </div>

    <p class="mt-1">
        {{ __('Increase the contrast for better readability') }}
    </p>

    <form class="w-full">
        <fieldset class="w-full">
            <legend class="absolute opacity-0 pointer-events-none">
                {{ __('Select your contrast preference') }}
            </legend>

            <div class="w-full grid lg:grid-cols-2 gap-2 mt-5">
                <label class="btn-wcag rounded-xl">
                    <div class="flex flex-row-reverse justify-between lg:flex-col w-full gap-y-3.5 pointer-events-none">
                        <div class="h-12 w-12 border border-solid border-accent-blue/10 rounded-lg flex justify-center items-center">
                            <x-svg
                                class="inline-flex w-4 text-primary/60"
                                src="assets/svg/text-lines"
                            />
                        </div>

                        <div class="flex flex-row items-center">
                            <input
                                class="js-toggle-contrast"
                                data-contrast="default"
                                type="radio"
                                name="contrast_option"
                                value="{{ __('Default') }} {{ __('Contrast') }}"
                                checked="true"
                            >

                            <span class="btn-wcag-title flex items-center text-left leading-5 pl-1.5">
                                {{ __('Default') }}
                            </span>
                        </div>
                    </div>
                </label>

                <label class="btn-wcag rounded-xl">
                    <div class="flex flex-row-reverse justify-between lg:flex-col w-full gap-y-3.5 pointer-events-none">
                        <div class="h-12 w-12 border border-solid border-accent-blue/10 rounded-lg flex justify-center items-center">
                            <x-svg
                                class="inline-flex w-4 text-primary"
                                src="assets/svg/text-lines"
                            />
                        </div>

                        <div class="flex flex-row items-center">
                            <input
                                class="js-toggle-contrast"
                                data-contrast="high"
                                type="radio"
                                name="contrast_option"
                                value="{{ __('High contrast') }}"
                                checked="false"
                            >

                            <span class="btn-wcag-title flex items-center text-left leading-5 pl-1.5">
                                {{ __('High contrast') }}
                            </span>
                        </div>
                    </div>
                </label>
            </div>
        </fieldset>
    </form>
</li>
