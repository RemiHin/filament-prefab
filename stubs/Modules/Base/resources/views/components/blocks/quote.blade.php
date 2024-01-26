<div class="flex flex-col w-full max-w-[768px] px-5 mx-auto mb-10 lg:mb-16">
    <q class="text-xl lg:text-2xl italic">
        {{ $block['data']['quote'] }}
    </q>
    <div class="flex flex-row items-center mt-4">
        @if($block['data']['image'])
            <div class="w-12 mr-4">
                <x-curator-glider :media="$block['data']['image']" />
            </div>
        @endif
        <div class="flex flex-col">
            <p class="font-semibold">
                {{ $block['data']['name'] }}
            </p>
            {{--            @if($block->caption)--}}
            {{--                <p>--}}
            {{--                    {{ $block->caption }}--}}
            {{--                </p>--}}
            {{--            @endif--}}
        </div>
    </div>
</div>
