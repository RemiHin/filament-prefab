<section class="w-full">
    <div class="relative container max-w-container">
        <x-svg
                class="svg-icon absolute right-0 bottom-0 h-[355px] md:h-[710px] w-[355px] md:w-[710px] inline-flex shrink-0"
                src="assets/svg/illustrations/ellipse-blue"
        />

        <fieldset class="flex justify-start lg:justify-center text-center">
            <legend class="absolute opacity-0 pointer-events-none">
                {{ __('Filter stories on category') }}
            </legend>

            <ul class="flex flex-wrap gap-2 list-none p-0 mt-2 mb-6">
                @foreach($storyCategoryFilters as $storyCategory)
                    <li>
                        <label for="label-{{ Str::slug($storyCategory->name) }}" class="checkbox-as-button">
                            <input
                                    id="label-{{ Str::slug($storyCategory->name) }}"
                                    type="checkbox"
                                    name="{{ $storyCategory->name }}"
                                    class="hidden"
                                    wire:model="categorieen.{{ $storyCategory->id }}"
                            />

                            <div class="checkbox-button cursor-pointer flex flex-row items-center gap-2 py-2 px-4 font-semibold rounded-full border transition-colors duration-150 ease-in-out @if($this->hasStoryCategory($storyCategory->id)) bg-secondary border-transparent text-white @else bg-secondary/10 text-primary border-primary font-medium hover:bg-secondary/20 @endif">
                                <span>
                                    {{ $storyCategory->name }}
                                </span>

                                @if($this->hasStoryCategory($storyCategory->id))
                                    <x-svg
                                            src="assets/svg/close"
                                            class="h-6 w-6 ml-2"
                                    />
                                @endif
                            </div>
                        </label>
                    </li>
                @endforeach
            </ul>
        </fieldset>

        <ul class="relative z-10 list-none pl-0 grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($stories as $story)
                <li>
                    <x-cards.story :story="$story" />
                </li>
            @endforeach
        </ul>

        <div class="py-10 lg:py-16">
            {{ $stories->onEachSide(1)->links() }}
        </div>
    </div>
</section>
