@props([
    'videoUrl',
    'videoUrlParameters' => null,
])

@if(CookieConsent::hasConsentFor('tracking'))
    <div {{ $attributes->merge(['class' => 'relative w-full h-auto pb-[65%] bg-dark-purple overflow-hidden']) }}>
        @if (str_contains($videoUrl, 'vimeo'))
            <iframe
                class="absolute h-full w-full top-0 left-0 object-cover"
                src="https://player.vimeo.com/video/{{ get_video_id($videoUrl) }}{{ $videoUrlParameters ? '?' . $videoUrlParameters : '' }}"
                frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
            ></iframe>
        @else
            <iframe
                class="absolute h-full w-full top-0 left-0 object-cover"
                src="https://www.youtube.com/embed/{{ get_video_id($videoUrl) }}{{ $videoUrlParameters ? '?' . $videoUrlParameters : '' }}"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
            ></iframe>
        @endif
    </div>
@else
    <div
        class="w-full h-auto flex flex-col justify-center items-center gap-4 p-5 bg-black aspect-video rounded-2xl">
        <p class="text-white text-center">
            {{ __('You cannot view this video due to your cookie settings. Also allow \'tracking\' cookies to watch this video.') }}
        </p>
        <x-button
            class="text-white"
            :href="url(CookieConsent::page()?->slug)"
            icon="chevron-right"
            :title="__('Change cookie settings')"
        />
    </div>
@endif
