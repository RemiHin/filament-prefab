<x-layouts.app>
    <x-seo-og :model="$model"></x-seo-og>

    @section('breadcrumbs')
        <x-content.breadcrumbs :backLink="url('/')" :backTitle="__('Back to home')">
            <x-content.breadcrumb :title="$model->name"/>
        </x-content.breadcrumbs>
    @endsection

    <section>
        <div class="container max-w-container-1/2">
            <div class="py-10 lg:py-16">
                <h1 class="heading-2 text-center">
                    {{ $model->name }}
                </h1>

                @if ($model->content)
                    <div class="editor pt-5">
                        {!! $model->intro !!}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <x-content.employee-overview/>
</x-layouts.app>
