@props([
    'service',
    'heading' => false,
])

<x-cards.card
    title="{{ $service->name }}"
    heading="{{ $heading }}"
    href="{{ route('service.show', ['service' => $service]) }}"
    text="{{ $service->intro }}"
    img="{{ $service->image?->getSignedUrl() }}"
    alt="{{ $service->image?->alt }}"
    label="{{ $service->label }}"
    landscape="true"
/>
