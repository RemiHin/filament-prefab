<section class="py-5 lg:py-10" id="job-alert-form">
    <div class="container max-w-container-1/2">
        @if($submitted && ! $updatedPreferences)
            <div class="heading-6 p-5 border-2 border-default-accent rounded-md" autofocus>
                {{ __('Thank you for filling the job alert form. You will receive an e-mail to confirm your e-mail address.') }}
            </div>
        @elseif($submitted && $updatedPreferences)
            <div class="heading-6 p-5 border-2 border-default-accent rounded-md" autofocus>
                {{ __('Preferences have been updated.') }}
            </div>
        @else($updatedPreferences)
            <form wire:submit.prevent="submit">
                @csrf

                @if ($errors->any())
                    <div class="p-5 border border-danger rounded-md mb-8" autofocus wire:key="{{ \Illuminate\Support\Str::random() }}">
                        <h2 class="text-lg mb-1.5">
                            {{ __('Something went wrong') }}
                        </h2>
                        <p class="mb-3">
                            {{ __('Please correct the points below and then try again') }}:
                        </p>

                        <ul class="list-none pl-0 flex flex-col gap-1.5">
                            @foreach ($errors->all() as $key=> $error)
                                <li>
                                    <a
                                        class="inline-flex items-center content-center text-danger underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out hover:decoration-current focus:decoration-current"
                                        href="#{{$errors->keys()[$key]}}"
                                    >
                                        {{ $error }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-8">
                    <label for="name" class="w-full font-bold text-base">
                        {{ __('Name') }} *
                        <input
                            id="name"
                            name="name"
                            type="text"
                            class="font-normal"
                            placeholder="{{ __('Name') }}"
                            wire:model.defer="name"
                            @error('first_name')aria-describedby="name_error"@enderror
                        >
                        @error('name')
                            <span role="alert" id="name_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="mb-8">
                    <label for="name" class="w-full font-bold text-base">
                        {{ __('Email address') }} *
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="font-normal"
                            placeholder="{{ __('Email address') }}"
                            wire:model.defer="email"
                            @error('email')aria-describedby="email_error"@enderror
                        >
                        @error('email')
                            <span role="alert" id="email_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="mb-8">
                    <label class="w-full font-bold text-base">
                        {{ __('Positions') }}
                    </label>
                    <ul class="flex flex-wrap list-none pl-0 mt-2">
                        @forelse(\App\Models\Position::all() as $position)
                            <li class="relative w-full sm:w-1/2 inline-flex py-1.5">
                                <input
                                    type="checkbox"
                                    id="position-{{ $position->id }}"
                                    class="rounded h-5 w-5 border-slate-200"
                                    name="positions[]"
                                    value="{{ $position->id }}"
                                    wire:model.defer="positions"
                                >
                                <label for="position-{{ $position->id }}">
                                    <span class="ml-3">{{ $position->name }}</span>
                                </label>
                            </li>
                        @empty
                            <div class="text-slate-600 italic">
                                {{ __('No results') }}
                            </div>
                        @endforelse
                    </ul>
                    @error('positions')
                        <span role="alert" id="email_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="w-full font-bold text-base">
                        {{ __('Educations') }}
                    </label>
                    <ul class="flex flex-wrap list-none pl-0 mt-2">
                        @forelse(\App\Models\Education::all() as $education)
                            <li class="relative w-full sm:w-1/2 inline-flex py-1.5">
                                <input
                                    type="checkbox"
                                    id="education-{{ $education->id }}"
                                    class="rounded h-5 w-5 border-slate-200"
                                    name="educations[]"
                                    value="{{ $education->id }}"
                                    wire:model.defer="educations"
                                >
                                <label for="education-{{ $education->id }}">
                                    <span class="ml-3">{{ $education->name }}</span>
                                </label>
                            </li>
                        @empty
                            <div class="text-slate-600 italic">
                                {{ __('No results') }}
                            </div>
                        @endforelse
                    </ul>
                    @error('educations')
                        <span role="alert" id="email_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="w-full font-bold text-base">
                        {{ __('Locations') }}
                    </label>
                    <ul class="flex flex-wrap list-none pl-0 mt-2">
                        @forelse(\App\Models\Location::visible()->get() as $location)
                            <li class="relative w-full sm:w-1/2 inline-flex py-1.5">
                                <input
                                    type="checkbox"
                                    id="location-{{ $location->id }}"
                                    class="rounded h-5 w-5 border-slate-200"
                                    name="locations[]"
                                    value="{{ $location->id }}"
                                    wire:model.defer="locations"
                                >
                                <label for="location-{{ $location->id }}">
                                    <span class="ml-3">{{ $location->name }}</span>
                                </label>
                            </li>
                        @empty
                            <div class="text-slate-600 italic">
                                {{ __('No results') }}
                            </div>
                        @endforelse
                    </ul>
                    @error('locations')
                        <span role="alert" id="email_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="w-full font-bold text-base">
                        {{ __('Hours') }}
                    </label>
                    <div id="slider" class="mt-6 max-w-[320px]" wire:ignore></div>
                </div>

                <div class="font-normal text-sm mb-5">
                    {{ __('* are required') }}
                </div>

                <button class="btn btn-primary text-gray-900">
                    {{ __('Send') }}

                    <x-svg
                        class="svg-icon relative inline-flex self-center h-5 w-5 ml-2"
                        src="assets/svg/arrow-right"
                    />
                </button>
            </form>
       @endif
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let container = document.getElementById('slider');

            let slider = window.noUiSlider.create(container, {
                start: [@this.hoursMin, @this.hoursMax],
                connect: true,
                tooltips: true,
                step: 1,
                format: wNumb({
                    decimal: 0,
                }),
                range: {
                    'min': 0,
                    'max': 40,
                },
            });

            slider.on('change', (values) => {
                @this.hoursMin = values[0];
                @this.hoursMax = values[1];
            });

            @this.on('updated-slider', (min, max) => {
                slider.set([min, max]);
            });
        });

        window.addEventListener('job-alert-form.scroll-top', () => {
            const form = window.document.querySelector('#job-alert-form');

            const y = form.getBoundingClientRect().top + window.scrollY + -150;

            window.scrollTo({top: y, behavior: 'smooth'});

        }, false);
    </script>
@endpush
