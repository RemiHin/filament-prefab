@if ($errors->any())
    <div class="pt-2 pb-3 px-5 mb-5 border-l-4 border-solid border-danger-600">
        <div class="flex flex-col md:flex-row gap-y-3 md:gap-x-3">
            <x-svg
                class="svg-icon relative inline-flex h-5 md:h-7 w-5 md:w-7 shrink-0 text-danger-600"
                src="assets/svg/warning"
            />

            <div class="flex flex-col w-full shrink">
                <p class="font-medium text-lg lg:text-xl text-danger-600">
                    {{ __('Something went wrong while submitting the form below.') }}
                </p>
                <p>
                    {{ __('Correct the fields below to send the form.') }}
                </p>

                <ul class="mt-1">
                    @foreach ($errors->keys() as $key)
                        <li>
                            <a
                                href="#{{ $key }}"
                                data-scroll-to="#{{ $key }}"
                                data-scroll-to-offset="180"
                                class="underline transition-colors duration-150 ease-in-out hover:text-danger-600"
                            >
                                {{ $errors->first($key) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
