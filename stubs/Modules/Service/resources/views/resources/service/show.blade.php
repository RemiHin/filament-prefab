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
        :img="$model->image?->getSignedUrl()"
        :alt="$model->image?->alt"
        class="mt-5"
    />

    <section class="container mt-10 lg:mt-16">
        {!! $model->description !!}
    </section>

    <section class="mt-10 lg:mt-16">
        <x-blocks :blocks="$model->content"></x-blocks>
    </section>
</x-layouts.app>
