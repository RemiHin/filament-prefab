<x-layouts.app>
    <x-seo-og></x-seo-og>

    <section class="py-5 lg:py-10">
        <div class="container max-w-container">
            <h1 class="heading-1">
                {{ __('Contact') }}
            </h1>
        </div>
    </section>

    <div class="container max-w-container flex gap-8 flex-wrap md:flex-nowrap">
        <div class="w-1/2">
            <ul class="p-0 m-0">
                <li class="list-none">{{ $contactSettings->street }} {{ $contactSettings->house_number }}</li>
                <li class="list-none">{{ $contactSettings->postcode }}</li>
                <li class="list-none">{{ $contactSettings->city }}</li>
                <li class="list-none">{{ $contactSettings->email }}</li>
                <li class="list-none">{{ $contactSettings->phone }}</li>
            </ul>
        </div>



        <div class="w-1/2">
            @if(Session::has('success'))
                <div class="text-lg text-gray-800 p-12">
                    Uw bericht is succesvol verzonden, wij nemen zo spoedig mogelijk contact met u op.
                </div>
            @else
                <form action="{{ route('contact') }}" method="post">
                    @csrf

                    <div>
                        <label for="name" class="text-lg font-bold text-gray-900">{{ __('Name') }} *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mt-4">
                        <label for="email" class="text-lg font-bold text-gray-900">{{ __('Email') }} *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mt-4">
                        <label for="message" class="text-lg font-bold text-gray-900">{{ __('Message') }} *</label>
                        <textarea
                            class="block w-full rounded border-gray-200"
                            rows="5"
                            id="message"
                            name="message"
                            required
                        >{{ old('message') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <x-button
                            class="btn-yellow animate-right self-start"
                            title="{{ __('Submit') }}"
                            icon="chevron-right"
                            buttonType="submit"
                        />
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-layouts.app>
