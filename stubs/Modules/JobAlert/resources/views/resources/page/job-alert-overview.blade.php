<x-layouts.app>
    @if($model->heroImage)
        <x-hero.hero
            :title="$model->heroImage->title"
            :text="$model->heroImage->content"
            :img="asset('storage/' . $model->heroImage->image)"
            :alt="$model->heroImage->image_alt"
            :primary-btn-text="$model->heroImage->primary_cta_text"
            :primary-btn-link="$model->heroImage->primary_cta_link"
            :secondary-btn-text="$model->heroImage->secondary_cta_text"
            :secondary-btn-link="$model->heroImage->secondary_cta_link"
        />
    @endif
    <x-seo-og :model="$model"></x-seo-og>

    @section('breadcrumbs')
        <x-content.breadcrumbs :backLink="url('/')" :backTitle="__('Back to home')">
            <x-content.breadcrumb :title="$model->name"/>
        </x-content.breadcrumbs>
    @endsection

    <section class="pt-5 lg:pt-10">
        <div class="container max-w-container-1/2">
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

    <livewire:job-alert-form></livewire:job-alert-form>

    <section class="mt-10 lg:mt-16">
        <x-blocks :blocks="$model->blocks"></x-blocks>
    </section>
</x-layouts.app>
