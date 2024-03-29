<x-layouts.app>
    <x-seo-og :model="$model"></x-seo-og>

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
