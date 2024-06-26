<x-layouts.app>
    <x-seo-og
        :model="$model"
        :title="$model->name"
        :description="$model->intro"
    />

    @section('breadcrumbs')
        @php
            $locationOverview = \App\Models\Label::getModel('location-overview');
        @endphp
        <x-content.breadcrumbs :backLink="url($locationOverview->slug)" :backTitle="__('Back to overview')">
            <x-content.breadcrumb :href="url($locationOverview->slug)" :title="$locationOverview->name"/>
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

    <section class="mt-10 lg:mt-16">
        <div class="container max-w-container">
            <ul class="list-none pl-0">
                <li>{{ $model->street }} {{ $model->house_number }}</li>
                <li>{{ $model->postal_code }} {{ $model->city }}</li>
                @if($model->phone)
                    <li class="flex">
                        <a
                            href="tel:{{ $model->phone }}"
                            target="_blank"
                            class="hover:underline"
                        >
                            {{ $model->phone }}
                        </a>
                    </li>
                @endif
                @if($model->email)
                    <li class="flex">
                        <a
                            href="mailto:{{ $model->email }}"
                            target="_blank"
                            class="hover:underline"
                        >
                            {{ $model->email }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </section>

    <section class="mt-10 lg:mt-16">
        <x-blocks :blocks="$model->content"></x-blocks>
    </section>
</x-layouts.app>
