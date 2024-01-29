@props([
    'blog',
    'heading' => false,
])

<x-cards.card
    title="{{ $blog->name }}"
    heading="{{ $heading }}"
    href="{{ route('blog.show', ['blog' => $blog]) }}"
    text="{{ $blog->intro }}"
    img="{{ $blog->image }}"
    alt="{{ $blog->image_alt }}"
    label="{{ $blog->label }}"
    date="{{ $blog->publish_from->format('d-m-Y') }}"
/>
