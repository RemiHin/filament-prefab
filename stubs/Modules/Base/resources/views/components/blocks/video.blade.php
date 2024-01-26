<div class="flex flex-col w-full max-w-[768px] px-5 mx-auto mb-10 lg:mb-16">
{{--   todo:  @if(CookieConsent::hasConsentFor('tracking'))--}}
        <div class="relative w-full h-0 pb-[56.25%] overflow-hidden">
            @if (Str::contains($block['data']['video_url'], 'vimeo'))
                <iframe
                        class="absolute h-full w-full top-0 left-0"
                        src="https://player.vimeo.com/video/{{ get_video_id($block['data']['video_url']) }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                ></iframe>
            @else
                <iframe
                        class="absolute h-full w-full top-0 left-0"
                        src="https://www.youtube.com/embed/{{ get_video_id($block['data']['video_url']) }}"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                ></iframe>
            @endif
        </div>
{{--  todo:  @else--}}
{{--        <div class="w-full h-auto p-5 bg-black text-white">--}}
{{--            <p class="mb-3">--}}
{{--                {{ __('You cannot view this video due to your cookie settings. Also allow \'tracking\' cookies to watch this video.') }}--}}
{{--            </p>--}}
{{--            <a href="{{ url(CookieConsent::page()?->slug) }}"--}}
{{--               class="underline mt-4">--}}
{{--                {{ __('Change cookie settings') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    @endif--}}
</div>
