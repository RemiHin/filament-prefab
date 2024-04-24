@props([
    'title' => '',
    'description' => '',
    'image' => null,
    'og' => null,
    'seo' => null,
    'url' =>  url()->current(),
    'type' => 'website',
])

@php
    if (!$title && $og && $og->title) {
        $title = $og->title;
    } else if(!$title && $seo && $seo->title) {
        $title = $seo->title;
    }

    if (!$description && $og && $og->description) {
        $description = $og->description;
    } else if(!$description && $seo && $seo->description) {
        $description = $seo->description;
    }

    if (!$image && $og && $og->image?->getSignedUrl()) {
        $image = asset($og->image?->getSignedUrl());
    } else if (!$image && config('seo.og_image')) {
        $image = asset(config('seo.og_image'));
    }

    if(empty($title)) {
        $title = config('seo.og_title');
    }
@endphp

<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ strip_tags($title) }}"/>
<meta property="og:description" content="{{ Str::limit(strip_tags($description), 200) }}"/>
<meta property="og:url" content="{{ $url }}"/>
@if($image)
    <meta property="og:image" content="{{ $image }}"/>
@endif
