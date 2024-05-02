

<section class="{{ $type }} relative flex flex-col w-full mt-10 lg:mt-12">
    <x-svg
        class="svg-icon absolute top-0 left-0 h-[264px] md:h-[528px] w-[264px] md:w-[528px] inline-flex shrink-0 transform -translate-y-1/2"
        src="assets/svg/illustrations/ellipse-yellow"
    />

    <x-svg
        class="svg-icon absolute right-0 bottom-0 h-[355px] md:h-[710px] w-[355px] md:w-[710px] inline-flex shrink-0 transform translate-y-1/2"
        src="assets/svg/illustrations/ellipse-blue"
    />

    <div class="flex flex-col gap-3">
        <div class="relative w-full max-w-[1280px] mx-auto px-5 z-10">
            <div class="flex flex-col md:flex-row items-start justify-between gap-5">
                <div class="flex flex-col shrink-0 gap-3 w-full lg:w-2/3 lg:pr-5">
                    <h2 class="text-4xl lg:text-5xl mb-2">
                        {{ $block->title }}
                    </h2>

                    @if($block->text)
                        <div class="flex flex-row items-start gap-2">
                            <p>
                                {!! $block->text !!}
                            </p>
                        </div>
                    @endif

                    <x-link
                        :href="url(get_model_for_label('story-overview'))"
                        :title="__('All stories')"
                        icon="chevron-right"
                    />
                </div>
            </div>
        </div>

        <ul class="container max-w-container grid grid-cols-1 gap-4 md:grid-cols-3 list-none py-2 pr-5">
            @foreach($block->getStories() as $story)
                <li class="swiper-slide">
                    <x-cards.story :story="$story" />
                </li>
            @endforeach
        </ul>
    </div>
</section>
