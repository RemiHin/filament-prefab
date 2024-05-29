<x-layouts.app>
    <x-seo-og :model="$model"></x-seo-og>

    @if($model->heroImage)
        <x-hero.hero
            :title="$model->heroImage->title"
            :text="$model->heroImage->content"
            :img="$model->heroImage->image?->getSignedUrl()"
            :alt="$model->heroImage->image?->alt"
            :primary-btn-text="$model->heroImage->primary_cta_text"
            :primary-btn-link="$model->heroImage->primary_cta_link"
            :secondary-btn-text="$model->heroImage->secondary_cta_text"
            :secondary-btn-link="$model->heroImage->secondary_cta_link"
        />
    @endif

    @section('breadcrumbs')
        <x-content.breadcrumbs :backLink="url('/')" :backTitle="__('Back to home')">
            <x-content.breadcrumb :title="$model->name"/>
        </x-content.breadcrumbs>
    @endsection

    <section class="py-5 lg:py-10">
        <div class="container max-w-container">
            @if(! $model->heroImage)
                <h1 class="heading-1">
                    {{ $model->name }}
                </h1>
            @endif
            <div class="editor mt-3">
                {!! $model->content !!}
            </div>
        </div>
    </section>

    <livewire:vacancy-search></livewire:vacancy-search>
</x-layouts.app>
