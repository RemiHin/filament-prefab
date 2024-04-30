@props([
    'story',
    'heading' => false,
])

<x-cards.card
    title="{{ $story->name }}"
    heading="{{ $heading }}"
    href="{{ route('story.show', ['story' => $story]) }}"
    text="{{ $story->intro }}"
    img="{{ $story->image?->getSignedUrl() }}"
    alt="{{ $story->image_alt }}"
    label="{{ $story->label }}"
    date="{{ $story->publish_from->format('d-m-Y') }}"
/>
