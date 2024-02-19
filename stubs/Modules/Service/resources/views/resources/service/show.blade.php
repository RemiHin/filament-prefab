<x-layouts.app>
    <x-seo-og
        :model="$model"
        :title="$model->name"
        :description="$model->intro"
    />

    @section('breadcrumbs')
        @php
            $serviceOverviewPage = \App\Models\Label::getModel('service-overview');
        @endphp
        <x-content.breadcrumbs :backLink="url($serviceOverviewPage->slug)" :backTitle="__('Back to overview')">
            <x-content.breadcrumb :href="url($serviceOverviewPage->slug)" :title="$serviceOverviewPage->name"/>
            <x-content.breadcrumb :title="$model->name"/>
        </x-content.breadcrumbs>
    @endsection

   <x-hero.hero
        :title="$model->name"
        :text="$model->intro"
        :img="$model->image"
        :alt="$model->image_alt"
        :date="$model->publish_from->translatedFormat('j F Y')"
        class="mt-5"
    />

    <section class="mt-10 lg:mt-16">
        <x-blocks :blocks="$model->content"></x-blocks>
    </section>
</x-layouts.app>
