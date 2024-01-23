@props([
    'src',
])

<span {{ $attributes }}>
    {{ inlineSVG($src) }}
</span>
