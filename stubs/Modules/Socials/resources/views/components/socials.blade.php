<ul {{ $attributes->merge(['class' => 'list-none flex flex-row gap-4 pl-0']) }}>
    @foreach($socials as $social)
        <li>
            <a
                href="{{ $social->url }}"
                target="_blank"
                rel="noopener"
                aria-label="{{ __('External link to :to', ['to' => $social->getName()]) }}"
                class="flex text-white hover:text-brand-darkblue transition duration-150 ease-in-out"
            >
                <x-filament::icon
                    icon="{{ $social->icon_name }}"
                    class="relative inline-flex self-center h-6 w-6"
                />
            </a>
        </li>
    @endforeach
</ul>
