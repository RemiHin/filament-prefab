<div class="flex flex-col w-full max-w-[1280px] px-5 gap-5 lg:gap-8 mx-auto mb-10 lg:mb-16 @if($block['data']['position'] === 'left') md:flex-row @endif @if($block['data']['position'] === 'right') md:flex-row-reverse @endif">
    <div class="w-full md:w-1/2">
        <x-curator-glider media="{{ $block['data']['image'] }}" />
    </div>
    <div class="w-full md:w-1/2">
        <div class="editor">
            {!! $block['data']['text'] !!}
        </div>
    </div>
</div>
