@php
    /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $vacancies */
    $vacancies = $this->getVacancies();
@endphp

<div>
    <div class="container max-w-container flex flex-col lg:flex-row gap-6 mb-12">
        {{-- Filters --}}
        <div class="w-full lg:w-[400px] max-w-full rounded-lg bg-default-accent p-4 flex flex-col self-start flex-shrink-0 text-primary-dark">
            <div class="relative mb-5">
                <label
                    class="absolute opacity-0 pointer-events-none"
                    for="vacancy-search-field"
                >
                    {{ __('Search') }}
                </label>

                <input
                    type="text"
                    id="vacancy-search-field"
                    class="search w-full px-4"
                    placeholder="{{ __('Search') }}"
                    wire:model.live.debounce.500ms="term"
                >
                <x-svg
                    class="absolute left-2.5 top-2.5 svg-icon inline-flex self-center h-5 w-5"
                    src="assets/svg/search"
                />
            </div>

            <div class="flex flex-col gap-4">
                <x-vacancy.search-dropdown
                    :title="__('Function')"
                    livewire-model="positions"
                    :models="$this->getPositions()"
                    model-attribute="name"
                    icon="function"
                    :open="Request::has('positions')"
                ></x-vacancy.search-dropdown>

                <x-vacancy.search-dropdown
                    :title="__('Education')"
                    livewire-model="educations"
                    :models="$this->getEducations()"
                    model-attribute="name"
                    icon="education"
                    :open="Request::has('educations')"
                ></x-vacancy.search-dropdown>

                <x-vacancy.search-dropdown
                    :title="__('Location')"
                    livewire-model="locations"
                    :models="$this->getLocations()"
                    model-attribute="name"
                    icon="marker"
                    :open="Request::has('locations')"
                ></x-vacancy.search-dropdown>

                <x-vacancy.search-slider
                    :title="__('Hours')"
                    icon="clock"
                    :open="Request::has('hoursMin') || Request::has('hoursMax')"
                ></x-vacancy.search-slider>
            </div>

            @if($this->hasFilters())
                <x-button
                    class="w-full btn-secondary btn-small justify-center mt-5"
                    :title="__('Reset filters')"
                    icon="close"
                    wire:click="resetFilters"
                />
            @endif
        </div>

        <div class="w-full">
            {{-- Removable filters--}}
            @if($this->hasFilters())
                <ul class="flex flex-row flex-wrap gap-2 p-0 mb-5">
                    @foreach($this->getFilterPositions() as $position)
                        <x-vacancy.filter-pill
                            :name="$position->name"
                            :value="$position->id"
                            model="positions"
                        ></x-vacancy.filter-pill>
                    @endforeach

                    @foreach($this->getFilterEducations() as $education)
                        <x-vacancy.filter-pill
                            :name="$education->name"
                            :value="$education->id"
                            model="educations"
                        ></x-vacancy.filter-pill>
                    @endforeach

                    @foreach($this->getFilterLocations() as $location)
                        <x-vacancy.filter-pill
                            :name="$location->name"
                            :value="$location->id"
                            model="locations"
                        ></x-vacancy.filter-pill>
                    @endforeach

                    @if($hoursMin > 0)
                        <x-vacancy.filter-pill
                            tabindex="0"
                            role="button"
                            onclick="resetHoursMin()"
                            @keydown.prevent.space="resetHoursMin()"
                        >
                            Min: {{ $hoursMin }} {{ __('hour') }}

                            <x-svg
                                class="svg-icon inline-flex self-center h-5 w-5 text-secondary"
                                src="assets/svg/close"
                            />
                        </x-vacancy.filter-pill>
                    @endif

                    @if($hoursMax < 40)
                        <x-vacancy.filter-pill
                            tabindex="0"
                            role="button"
                            onclick="resetHoursMax()"
                            @keydown.prevent.space="resetHoursMax()"
                        >
                            Max: {{ $hoursMax }} {{ __('hour') }}

                            <x-svg
                                class="svg-icon inline-flex self-center h-5 w-5 text-secondary"
                                src="assets/svg/close"
                            />
                        </x-vacancy.filter-pill>
                    @endif
                </ul>
            @endif

            {{-- Results --}}
            @if($vacancies->count())
                <ul class="flex flex-col gap-5 list-none pl-0">
                    @php /** @var \App\Models\Vacancy $vacancy */ @endphp
                    @foreach($vacancies->items() as $vacancy)
                        <li class="relative bg-white shadow-xl rounded-lg px-5 pt-4 pb-3 lg:px-8 lg:pt-7 lg:pb-6 transition duration-150 ease-in-out">
                            <div class="flex flex-row items-end flex-wrap gap-x-4 mb-5">
                                <h2 class="heading-5">
                                    <a href="{{ $vacancy->getRoute() }}" class="full-click text-default-color">
                                        {{ $vacancy->name }}
                                    </a>
                                </h2>

                                @if($vacancy->hours)
                                    <span class="text-lg font-bold text-primary">{{ html_entity_decode($vacancy->hours) }} {{ __('uur') }}</span>
                                @endif
                            </div>

                            <ul class="list-none pl-0 flex flex-wrap gap-x-4 md:gap-x-6 gap-y-2 text-primary">
                                @if($vacancy->position)
                                    <li class="w-full lg:w-auto flex">
                                        <x-svg
                                            class="svg-icon inline-flex self-center h-5 w-5 text-secondary mr-3"
                                            src="assets/svg/function"
                                        />

                                        {{ $vacancy->position->name }}
                                    </li>
                                @endif
                                @if($vacancy->educations->count())
                                    <li class="w-full lg:w-auto flex">
                                        <x-svg
                                            class="svg-icon inline-flex self-center h-5 w-5 text-secondary mr-3"
                                            src="assets/svg/education"
                                        />

                                        {{ implode(', ', $vacancy->educations->pluck('name')->toArray()) }}
                                    </li>
                                @endif
                                @if($vacancy->location)
                                    <li class="w-full lg:w-auto flex">
                                        <x-svg
                                            class="svg-icon inline-flex self-center h-5 w-5 text-secondary mr-3"
                                            src="assets/svg/marker"
                                        />

                                        {{ $vacancy->location->name }}
                                    </li>
                                @endif
                            </ul>

                            <div class="btn btn-small btn-clean btn-secondary mt-2">
                                {{ __('Read more') }}

                                <x-svg
                                    class="svg-icon relative inline-flex self-center h-5 w-5 ml-2"
                                    src="assets/svg/arrow-right"
                                />
                            </div>
                        </li>
                    @endforeach

                    {{ $vacancies->links() }}
                </ul>
            @else
                <div class="relative rounded border-4 border-default-accent px-5 py-4 lg:px-10 lg:py-7 text-center font-bold text-2xl text-default-color">
                    {{ __('No vacancies found') }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function resetHoursMin() {
            @this.hoursMin = 0;
        }

        function resetHoursMax() {
            @this.hoursMax = 40;
        }
    </script>
@endpush
