@props([
    'newsItem',
    'heading' => false,
])

<x-cards.card
    title="{{ $newsItem->name }}"
    heading="{{ $heading }}"
    href="{{ route('news.show', ['newsItem' => $newsItem]) }}"
    text="{{ $newsItem->intro }}"
    img="{{ $newsItem->image?->getSignedUrl() }}"
    alt="{{ $newsItem->image?->alt }}"
    label="{{ $newsItem->label }}"
    date="{{ $newsItem->publish_from->format('d-m-Y') }}"
/>
