<x-layouts.app>
    <x-seo-og :model="$model"></x-seo-og>

    @section('breadcrumbs')
        <x-content.breadcrumbs :backLink="url('/')" :backTitle="__('Back to home')">
            <x-content.breadcrumb :title="$model->name"/>
        </x-content.breadcrumbs>
    @endsection

    @if($model->heroImage)
        <x-hero.hero
                :title="$model->heroImage->title"
                :text="$model->heroImage->content"
                :img="$model->heroImage->image?->getSignedUrl()"
                :alt="$model->heroImage->image_alt"
                :primaryBtnText="$model->heroImage->cta_text"
                :primaryBtnLink="$model->heroImage->cta_link"
                class="mt-5"
        />
    @endif

    <section class="py-5 lg:py-10">
        <div class="container max-w-container">
            @if(! $model->heroImage)
                <h1 class="heading-1">
                    {{ $model->name }}
                </h1>
            @endif

            <div class="editor mt-3">
                {!! $model->intro !!}
            </div>
        </div>
    </section>

    <section class="mt-10 lg:mt-16">
        <x-blocks :blocks="$model->content"></x-blocks>
    </section>
</x-layouts.app>
