@props([
    'model' => null,
    'title' => null,
    'description' => null,
])

@if($model)
    @section('seo')
        <x-seo
            :title="$title"
            :description="$description"
            :seo="$model->seo"
        />
    @endsection

    @section('og')
        <x-og
            :title="$title"
            :description="$description"
            :seo="$model->seo"
        />
    @endsection
@endif
