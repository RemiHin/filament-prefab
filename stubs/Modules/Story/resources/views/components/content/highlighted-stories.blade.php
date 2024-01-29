@if($stories->isNotEmpty())
    <div class="container max-w-container mb-8">
        <h3 class="mb-4">@lang('Stories')</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($stories as $story)
                <x-cards.story :story="$story"></x-cards.story>
            @endforeach
        </div>
    </div>
@endif
