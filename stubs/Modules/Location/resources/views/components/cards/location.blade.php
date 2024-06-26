@props([
    'location',
    'heading' => false,
])

<x-cards.card
    title="{{ $location->name }}"
    heading="{{ $heading }}"
    href="{{ $location->getRoute() }}"
    img="{{ $location->image?->getSignedUrl() }}"
    alt="{{ $location->image?->alt }}"
    label="{{ $location->label }}"
>
    <x-slot name="text">
        <span>{{ $location->street }} {{ $location->street_number }}</span>
        <span>{{ $location->postcode }} {{ $location->city }}</span>
    </x-slot>
</x-cards.card>
