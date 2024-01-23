@if(! empty($success) || ! empty(session('status')) || ! empty(session()->get('success') ))
    <div class="p-5 rounded-md lg:rounded-lg bg-default-accent mb-5">
        <div class="flex flex-col md:flex-row items-center gap-y-3 md:gap-x-5">
            <div class="flex items-center justify-center rounded-full h-[196px] w-[196px] bg-accent-blue/10 shrink-0">
                <x-svg
                    class="svg-icon relative inline-flex h-[100px] w-[100px] shrink-0 text-accent-blue"
                    src="assets/svg/paper-plane"
                />
            </div>

            <div class="flex flex-col w-full shrink">
                <p class="font-medium text-lg lg:text-xl text-primary">
                    {{ $success ?? session('status') ?? session()->get('success') }}

                    @lang('Your message has successfully been sent!')
                </p>
            </div>
        </div>
    </div>
@endif
