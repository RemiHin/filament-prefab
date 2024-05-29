<x-layouts.app-stripped>
    <x-seo-og :model="$vacancy"></x-seo-og>

    <div class="w-full md:mt-10">
        <livewire:application-form :vacancy="$vacancy"/>
    </div>
</x-layouts.app-stripped>
