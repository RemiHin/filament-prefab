<div class="relative py-10">
    @if(!$success)
        <div class="w-full">
            <div class="container max-w-container grid md:grid-cols-2 gap-10">
                <div>
                    <div class="flex flex-col gap-5 bg-primary-dark text-white">
                        <div class="flex flex-col p-5 md:p-10">
                            <h1 class="heading-4">
                                {{ __('How nice that you\'re applying to our vacancy') }}
                            </h1>

                            <div class="flex flex-col mt-5 md:mt-10">
                                <h2 class="heading-6">
                                    {{ $vacancy->name }}
                                </h2>
                                <p class="mt-1 text-sm">
                                    {{ $vacancy->hours_min }} - {{ $vacancy->hours_max }} {{ __('uur') }}
                                </p>

                                <ul class="list-none pl-0 flex flex-wrap gap-4 md:gap-6 font-bold mt-5">
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
                            </div>
                        </div>

                        <img
                            class="w-full"
                            src="{{ asset('assets/images/fallback-application.svg') }}"
                            alt=""
                        >
                    </div>
                </div>

                <form wire:submit.prevent="submit" class="relative md:pt-10">
                    <div wire:loading wire:target="submit" class="absolute z-50 top-0 w-full h-full bg-white opacity-25"></div>
                    <h2 class="heading-5 mb-5">
                        {{ __('We need a little information') }}
                    </h2>

                    @if ($errors->any())
                        <div class="p-5 border border-danger rounded-md mb-8" autofocus wire:key="{{ \Illuminate\Support\Str::random() }}">
                            <h3 class="text-lg mb-1.5">
                                {{ __('Something went wrong') }}
                            </h3>
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

                    <div class="flex flex-col gap-5 font-bold">
                        <div class="flex flex-col lg:flex-row gap-5 lg:gap-2.5 justify-between">
                            <label for="first_name" class="w-full">
                                {{ __('First Name') }} *
                                <input
                                    name="first_name"
                                    id="first_name"
                                    type="text"
                                    class="@error('first_name')form-has-error @enderror font-normal text-sm"
                                    placeholder="{{ __('First Name') }}"
                                    wire:model.defer="formData.first_name"
                                    @error('first_name')aria-describedby="first_name_error"@enderror
                                >
                                @error('first_name')
                                    <span role="alert" id="first_name_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </label>

                            <label for="addition" class="w-full">
                                {{ __('Addition') }}
                                <input
                                    name="addition"
                                    id="addition"
                                    type="text"
                                    class="@error('addition')form-has-error @enderror font-normal text-sm"
                                    placeholder="{{ __('Addition') }}"
                                    wire:model.defer="formData.addition"
                                    @error('addition')aria-describedby="addition_error"@enderror
                                >
                                @error('addition')
                                    <span role="alert" id="addition_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </label>

                            <label for="last_name" class="w-full">
                                {{ __('Last Name') }} *
                                <input
                                    name="last_name"
                                    id="last_name"
                                    type="text"
                                    class="@error('last_name')form-has-error @enderror font-normal text-sm"
                                    placeholder="{{ __('Last Name') }}"
                                    wire:model.defer="formData.last_name"
                                    @error('last_name')aria-describedby="last_name_error"@enderror
                                >
                                @error('last_name')
                                    <span role="alert" id="last_name_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>

                        <label for="email">
                            {{ __('Email address') }} *
                            <input
                                name="email"
                                id="email"
                                type="text"
                                class="@error('email')form-has-error @enderror font-normal text-sm"
                                placeholder="{{ __('Email address') }}"
                                wire:model.defer="formData.email"
                                @error('email')aria-describedby="email_error"@enderror
                            >
                            @error('email')
                                <span role="alert" id="email_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </label>

                        <label for="phone">
                            {{ __('Phone number') }}
                            <input
                                name="phone"
                                id="phone"
                                type="text"
                                class="@error('phone')form-has-error @enderror font-normal text-sm"
                                placeholder="{{ __('Phone number') }}"
                                wire:model.defer="formData.phone"
                                @error('phone')aria-describedby="phone_error"@enderror
                            >
                            @error('phone')
                                <span role="alert" id="phone_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </label>

                        <div class="flex flex-col gap-1">
                            <label for="motivation">
                                {{ __('Motivation') }}
                            </label>
                            <textarea
                                type="textarea"
                                name="motivation"
                                id="motivation"
                                rows="10"
                                class="@error('motivation')form-has-error @enderror font-normal text-sm"
                                placeholder="{{ __('Motivation') }}"
                                wire:model.defer="formData.motivation" @error('phone')aria-describedby="motivation_error"@enderror></textarea>
                            @error('motivation')
                                <span role="alert" id="motivation_error" class="text-sm text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="!flex gap-2 items-center justify-between file-upload-field !p-0 @error('cv')form-has-error @enderror">
                                <p class="whitespace-nowrap truncate pl-6">
                                    {{ $cv ? $cv->getClientOriginalName() : '' }}
                                </p>
                                <label
                                    role="button"
                                    tabindex="0"
                                    class="btn btn-donate text-gray-900 whitespace-nowrap flex items-center gap-2 focus-visible:outline-dashed focus-visible:outline-offset-2 focus-visible:outline-2"
                                    for="cv"
                                >
                                    <span wire:loading.remove wire:target="cv">
                                        {{ __('Upload CV') }}
                                    </span>

                                    <x-svg
                                        wire:loading.remove wire:target="cv"
                                        class="h-5 w-5 flex justify-center items-center"
                                        src="assets/svg/upload"
                                    />

                                    <svg wire:loading wire:target="cv" aria-hidden="true"
                                         class="mr-2 w-5 h-5 text-gray-200 animate-spin fill-horizon" viewBox="0 0 100 101"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor"/>
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill"/>
                                    </svg>

                                    <span wire:loading wire:target="cv">
                                        {{ __('Uploading') }}...
                                    </span>
                                </label>

                                <input
                                    wire:model.defer="cv" type="file" name="cv" id="cv"
                                    tabindex="-1"
                                    accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf"
                                    class="w-0 h-0 opacity-0 absolute"
                                    @error('cv')aria-describedby="cv_error"@enderror
                                >
                            </div>
                            @error('cv')
                                <span role="alert" id="cv_error" class="text-sm text-danger mt-2">{{ $message }} </span>
                            @enderror
                        </div>

                        <div class="font-normal text-sm">
                            {{ __('* are required') }}
                        </div>

                        <div wire:loading.remove wire:target="submit" >
                            <x-button
                                type="submit"
                                class="btn btn-primary text-gray-900"
                                icon="arrow-right"
                                title="{{ __('Apply now') }}"
                            />
                        </div>

                        <div wire:loading wire:target="submit">
                            <div class="btn btn-primary opacity-50 cursor-not-allowed">
                                <svg aria-hidden="true"
                                     class="mr-2 w-6 h-6 text-gray-200 animate-spin fill-horizon" viewBox="0 0 100 101"
                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor"/>
                                    <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill"/>
                                </svg>
                                <span>{{ __('Submitting') }}...</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="col-span-2 w-full flex flex-col items-center justify-center h-full">
            <div class="container max-w-container flex flex-col items-center justify-center">
                <h1 class="heading-1">
                    {{ __('Amazing!') }}
                </h1>
                <div class="heading-6 font-bold text-center mt-2">
                    {{ __('Your application has been successfully sent, now what?') }}
                </div>

                <ul class="w-full list-none pl-0 mt-10 grid md:grid-cols-3 gap-5">
                    <li class="rounded-md bg-default-accent w-full flex flex-row md:flex-col gap-5 items-center p-5 md:p-10 md:text-center">
                        <div class="rounded-full bg-white w-1/4 md:w-1/2 aspect-square flex items-center justify-center shrink-0">
                            <x-svg
                                class="w-1/2 aspect-square"
                                src="assets/svg/magnefying-glass"
                            />
                        </div>
                        <div class="text-lg">
                            {{ __('We will review your application') }}
                        </div>
                    </li>

                    <li class="rounded-md bg-default-accent w-full flex flex-row md:flex-col gap-5 items-center p-5 md:p-10 md:text-center">
                        <div class="rounded-full bg-white w-1/4 md:w-1/2 aspect-square flex items-center justify-center shrink-0">
                            <x-svg
                                class="w-1/2 aspect-square"
                                src="assets/svg/old-phone"
                            />
                        </div>
                        <div class="text-lg">
                            {{ __('We will contact you') }}
                        </div>
                    </li>

                    <li class="rounded-md bg-default-accent w-full flex flex-row md:flex-col gap-5 items-center p-5 md:p-10 md:text-center">
                        <div class="rounded-full bg-white w-1/4 md:w-1/2 aspect-square flex items-center justify-center shrink-0">
                            <x-svg
                                class="w-1/2 aspect-square"
                                src="assets/svg/wave"
                            />
                        </div>
                        <div class="text-lg">
                            {{ __('We will invite you for an interview') }}
                        </div>
                    </li>
                </ul>

                <div class="mt-6">
                    <x-button
                        href="{{ route('vacancy.index') }}"
                        class="btn btn-primary text-gray-900"
                        icon="arrow-right"
                        title="{{ __('Back to vacancy overview') }}"
                    />
                </div>
            </div>
        </div>
    @endif
</div>
