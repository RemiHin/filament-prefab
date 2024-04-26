<x-layouts.app :show-cookie-consent="false">
    <x-seo-og :model="$model"></x-seo-og>

    @section('breadcrumbs')
        <x-content.breadcrumbs :backLink="url('/')" :backTitle="__('Back to home')">
            <x-content.breadcrumb :title="$model->name" />
        </x-content.breadcrumbs>
    @endsection

    <section class="py-5 lg:py-10">
        <div class="container max-w-container">
            <h1 class="heading-1">
                {{ $model->name }}
            </h1>
            <div class="editor mt-3">
                {!! $model->intro !!}
            </div>
        </div>

        <div class="container max-w-container mt-10">
            @cookieConsentForm()
        </div>
    </section>

    <section class="mt-10 lg:mt-16">
        <x-blocks :blocks="$model->content"></x-blocks>
    </section>
</x-layouts.app>
