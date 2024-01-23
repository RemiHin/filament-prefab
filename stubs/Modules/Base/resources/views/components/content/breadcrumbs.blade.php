@props([
    'backLink' => url('/'),
    'backTitle' => __('Back'),
])

<section {{ $attributes->merge(['class' => 'breadcrumbs flex gap-2.5 w-full px-5 py-5 text-sm']) }}>
    <x-button
        :href="$backLink"
        :title="$backTitle"
        icon="arrow-left"
        aria-label="{{ __('One page back') }}"
        class="lg:hidden btn-secondary btn-reverse btn-small btn-clean"
    />

    <ul class="hidden lg:flex p-0 gap-2.5">
        <x-content.breadcrumb :title="__('Home')" :href="url('/')" />

        {{ $slot }}
    </ul>
</section>
