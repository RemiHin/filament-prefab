<ul class="list-none flex flex-row gap-4 pl-0">
    @if(config('social.facebook'))
        <li>
            <a
                href="{{ config('social.facebook') }}"
                target="_blank"
                rel="noopener"
                aria-label="{{ __('External link to :to', ['to' => 'Facebook']) }}"
                class="flex"
            >
                <x-svg
                    class="svg-icon relative inline-flex self-center h-8 w-8 text-primary"
                    src="assets/svg/socials/facebook"
                />
            </a>
        </li>
    @endif

    @if(config('social.linked-in'))
        <li>
            <a
                href="{{ config('social.linked-in') }}"
                target="_blank"
                rel="noopener"
                aria-label="{{ __('External link to :to', ['to' => 'LinkedIn']) }}"
                class="flex"
            >
                <x-svg
                    class="svg-icon relative inline-flex self-center h-8 w-8 text-primary"
                    src="assets/svg/socials/linkedin"
                />
            </a>
        </li>
    @endif

    @if(config('social.instagram'))
        <li>
            <a
                href="{{ config('social.instagram') }}"
                target="_blank"
                rel="noopener"
                aria-label="{{ __('External link to :to', ['to' => 'Instagram']) }}"
                class="flex"
            >
                <x-svg
                    class="svg-icon relative inline-flex self-center h-8 w-8 text-primary"
                    src="assets/svg/socials/instagram"
                />
            </a>
        </li>
    @endif

    @if(config('social.twitter'))
        <li>
            <a
                href="{{ config('social.twitter') }}"
                target="_blank"
                rel="noopener"
                aria-label="{{ __('External link to :to', ['to' => 'Twitter']) }}"
                class="flex"
            >
                <x-svg
                    class="svg-icon relative inline-flex self-center h-8 w-8 text-primary"
                    src="assets/svg/socials/twitter"
                />
            </a>
        </li>
    @endif

    @if(config('social.youtube'))
        <li>
            <a
                href="{{ config('social.youtube') }}"
                target="_blank"
                rel="noopener"
                aria-label="{{ __('External link to :to', ['to' => 'Youtube']) }}"
                class="flex"
            >
                <x-svg
                    class="svg-icon relative inline-flex self-center h-8 w-8 text-primary"
                    src="assets/svg/socials/youtube"
                />
            </a>
        </li>
    @endif
</ul>
