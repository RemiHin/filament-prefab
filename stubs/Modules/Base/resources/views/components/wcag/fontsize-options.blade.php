<li class="flex flex-col">
    <div class="flex flex-row flex-nowrap">
        <x-svg
            class="inline-flex w-5 mr-2 lg:mr-4 flex-shrink-0 text-secondary"
            src="assets/svg/text-size"
        />
        <h3 class="text-lg">
            {{ __('Text size') }}
        </h3>
    </div>

    <p class="mt-1">
        {{ __('Change the text size to your liking') }}
    </p>

    <form class="w-full">
        <fieldset class="w-full">
            <legend class="absolute opacity-0 pointer-events-none">
                {{ __('Select your fontsize preference') }}
            </legend>

            <div class="grid lg:grid-cols-4 gap-2 mt-5 wcag-fontsize-options">
                <label class="btn-wcag rounded-xl">
                    <div class="flex flex-row-reverse justify-between lg:flex-col w-full gap-y-3.5 pointer-events-none">
                        <div class="h-12 w-12 border border-solid border-accent-blue/10 rounded-lg flex justify-center items-center">
                            <x-svg
                                class="inline-flex w-2.5 text-primary"
                                src="assets/svg/text-letter"
                            />
                        </div>

                        <div class="flex flex-row items-center">
                            <input
                                class="js-toggle-fontsize"
                                data-fontsize="default"
                                type="radio"
                                name="fontsize_option"
                                value="{{ __('Text size') }} {{ __('Default') }}"
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
                                class="inline-flex w-2.5 transform scale-[1.3] text-primary"
                                src="assets/svg/text-letter"
                            />
                        </div>

                        <div class="flex flex-row items-center">
                            <input
                                class="js-toggle-fontsize"
                                data-fontsize="m"
                                type="radio"
                                name="fontsize_option"
                                value="{{ __('Text size') }} {{ __('Medium') }}"
                                checked="false"
                            >

                            <span class="btn-wcag-title flex items-center text-left leading-5 pl-1.5">
                                {{ __('Medium') }}
                            </span>
                        </div>
                    </div>
                </label>

                <label class="btn-wcag rounded-xl">
                    <div class="flex flex-row-reverse justify-between lg:flex-col w-full gap-y-3.5 pointer-events-none">
                        <div class="h-12 w-12 border border-solid border-accent-blue/10 rounded-lg flex justify-center items-center">
                            <x-svg
                                class="inline-flex w-2.5 transform scale-[1.6] text-primary"
                                src="assets/svg/text-letter"
                            />
                        </div>

                        <div class="flex flex-row items-center">
                            <input
                                class="js-toggle-fontsize"
                                data-fontsize="l"
                                type="radio"
                                name="fontsize_option"
                                value="{{ __('Text size') }} {{ __('Large') }}"
                                checked="false"
                            >

                            <span class="btn-wcag-title flex items-center text-left leading-5 pl-1.5">
                                {{ __('Large') }}
                            </span>
                        </div>
                    </div>
                </label>

                <label class="btn-wcag rounded-xl">
                    <div class="flex flex-row-reverse justify-between lg:flex-col w-full gap-y-3.5 pointer-events-none">
                        <div class="h-12 w-12 border border-solid border-accent-blue/10 rounded-lg flex justify-center items-center">
                            <x-svg
                                class="inline-flex w-2.5 transform scale-[2] text-primary"
                                src="assets/svg/text-letter"
                            />
                        </div>

                        <div class="flex flex-row items-center">
                            <input
                                class="js-toggle-fontsize"
                                data-fontsize="xl"
                                type="radio"
                                name="fontsize_option"
                                value="{{ __('Text size') }} {{ __('Extra large') }}"
                                checked="false"
                            >

                            <span class="btn-wcag-title flex items-center text-left leading-5 pl-1.5">
                                {{ __('Extra large') }}
                            </span>
                        </div>
                    </div>
                </label>
            </div>
        </fieldset>
    </form>
</li>
