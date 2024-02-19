@props([
    'service',
    'heading' => false,
])

<x-cards.card
    title="{{ $service->name }}"
    heading="{{ $heading }}"
    href="{{ route('service.show', ['service' => $service]) }}"
    text="{{ $service->intro }}"
    img="{{ $service->image }}"
    alt="{{ $service->image_alt }}"
    label="{{ $service->label }}"
    landscape="true"
/>
