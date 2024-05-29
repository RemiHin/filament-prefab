<x-layouts.app>
    <x-seo-og :model="$model"></x-seo-og>

    @push('structured-data')
        <script type="application/ld+json">
        {
        "@context" : "https://schema.org/",
        "@type" : "JobPosting",
        "title" : "{{ $model->name }}",
        "description" : "{!! $model->intro ?? '' !!}",
        "datePosted" : "{{ $model->publish_at ? $model->publish_at->translatedFormat('Y-m-d') : $model->created_at->translatedFormat('Y-m-d') }}",
        "validThrough" : "{{ $model->publish_until ? $model->publish_until->translatedFormat('Y-m-d') : '' }}",
        "employmentType" : "CONTRACTOR",
        "hiringOrganization" : {
            "@type" : "Organization",
            "name" : "{{ config('app.name') }}",
            "sameAs" : "{{ url('/') }}",
            "logo" : "{{ url('/assets/logo.svg') }}"
        },
        @if($model->location)"jobLocation": {
            "@type": "Place",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ $model->location->street }} {{ $model->location->house_number }}",
                "addressLocality": "{{ $model->location->city }}",
                "postalCode": "{{ $model->location->postal_code }}",
                "addressCountry": "NL"
            }
        },@endif
        "baseSalary": {
            "@type": "MonetaryAmount",
            "currency": "EUR",
            "value": {
                "@type": "QuantitativeValue",
                "maxValue": {{ $model->salary_max ?? $model->salary_min ?? '' }},
                "unitText": "MONTH"
            }
        }
        }
        </script>
    @endpush

    @section('breadcrumbs')
        @php
            $overviewPage = \App\Models\Label::getModel('vacancy-overview');
        @endphp
        <x-content.breadcrumbs :backLink="url($overviewPage->slug)" :backTitle="__('Back to overview')">
            <x-content.breadcrumb :href="url($overviewPage->slug)" :title="$overviewPage->name"/>
            <x-content.breadcrumb :title="$model->name"/>
        </x-content.breadcrumbs>
    @endsection

    <section class="py-5 lg:py-10">
        <div class="container max-w-container">
            <div class="flex flex-col-reverse gap-5">
                <div class="flex flex-col md:flex-row md:flex-wrap md:items-end gap-4">
                    <h1 class="heading-1">
                        {{ $model->name }}
                    </h1>

                    <span class="heading-5 text-primary md:mb-2">
                        {{ html_entity_decode($model->hours) }} {{ __('hour') }}
                    </span>
                </div>

                <ul class="list-none pl-0 flex flex-row flex-wrap gap-2 md:gap-3">
                    @if($model->contractType)
                        <li class="flex items-center gap-3 text-default-color px-3 py-1.5 rounded @if($model->contractType->name == "Open") text-green-800 bg-green-100 @else text-red-700 bg-red-100 @endif">
                            <span class="h-1.5 w-1.5 rounded-full @if($model->contractType->name == "Open") bg-green-600 @else bg-red-600 @endif"></span>
                            {{ $model->contractType->name }}
                        </li>
                    @endif

                    @if($model->position)
                        <li class="flex items-center gap-3 text-default-color px-3 py-1.5 rounded bg-default-accent">
                            <x-svg
                                    class="svg-icon inline-flex self-center h-5 w-5 text-secondary"
                                    src="assets/svg/function"
                            />

                            {{ $model->position->name }}
                        </li>
                    @endif

                    @if($model->location)
                        <li class="flex items-center gap-3 text-default-color px-3 py-1.5 rounded bg-default-accent">
                            <x-svg
                                    class="svg-icon inline-flex self-center h-5 w-5 text-secondary"
                                    src="assets/svg/marker"
                            />

                            {{ $model->location->name }}
                        </li>
                    @endif

                    @if($model->educations->count())
                        @foreach($model->educations as $education)
                            <li class="flex items-center gap-3 text-default-color px-3 py-1.5 rounded bg-default-accent">
                                <x-svg
                                        class="svg-icon inline-flex self-center h-5 w-5 text-secondary"
                                        src="assets/svg/education"
                                />

                                {{ $education->name }}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </section>

    @if(! empty($model->meta))
        <section>
            <div class="container max-w-container">
                <ul class="mt-4 pl-4">
                    @foreach($model->meta as $meta)
                        @if(! empty($meta ))
                            <li>
                                {{ $meta }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if($model->intro)
        <section class="mt-10 lg:mt-16">
            <div class="container max-w-container">
                {{ $model->intro }}
            </div>
        </section>
    @endif

    <section class="mt-10 lg:mt-16">
        <x-blocks :blocks="$model->blocks"></x-blocks>
    </section>

    <section class="sticky w-full bottom-0 mt-10 lg:mt-16 backdrop-blur bg-white/90 z-10">
        <div class="py-4 md:py-5">
            <div class="container max-w-container">
                <div class="w-full flex flex-row items-center justify-between">
                    <div class="w-[calc(100%-170px)] flex flex-row flex-wrap items-center shrink gap-1">
                        <div class="w-full">
                            <h2 class="heading-6 overflow-hidden text-ellipsis whitespace-nowrap">
                                {{ $model->name }}
                            </h2>
                        </div>

                        <span class="md:text-lg text-primary">
                            {{ html_entity_decode($model->hours) }} {{ __('hour') }}
                            @if($model->salary) / {{ html_entity_decode($model->salary) }} @endif
                        </span>
                    </div>

                    <x-button
                        href="{{ route('application.form', ['vacancy' => $model]) }}"
                        class="btn-primary text-gray-900 shrink-0 bg-secondary border-secondary hover:bg-secondary-dark hover:border-secondary-dark"
                        :title="__('Apply')"
                        icon="arrow-right"
                    />
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
