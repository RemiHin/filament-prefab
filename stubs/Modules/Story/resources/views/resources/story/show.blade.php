<x-layouts.app>
    <x-seo-og
        :model="$model"
        :title="$model->name"
        :description="$model->intro"
    />

    @push('structured-data')
        <script type="application/ld+json">
        { "@context": "https://schema.org",
        "@type": "Article",
        "author": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}"
        },
        "headline": "{{ $model->name }}",
        "image": "{{ $model->image }}",
        "description": "{{ $model->intro }}",
        "datePublished": "{{ $model->publish_from->translatedFormat('Y-m-d') }}",
        "dateCreated": "{{ $model->created_at->translatedFormat('Y-m-d') }}",
        "dateModified": "{{ $model->updated_at->translatedFormat('Y-m-d') }}",
        "publisher": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}",
            "logo": "{{ url('/assets/logo.svg') }}",
        },
        "url": "{{ url()->current() }}",
        }
        </script>
    @endpush

    @section('breadcrumbs')
        @php
            $storyOverviewPage = \App\Models\Label::getModel('story-overview');
        @endphp
        <x-content.breadcrumbs :backLink="url($storyOverviewPage->slug)" :backTitle="__('Back to overview')">
            <x-content.breadcrumb :href="url($storyOverviewPage->slug)" :title="$storyOverviewPage->name"/>
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
