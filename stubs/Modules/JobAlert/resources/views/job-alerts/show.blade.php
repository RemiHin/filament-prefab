<x-layouts.app>
    <section class="py-5 lg:py-10">
        <div class="container max-w-container">
            <h1 class="heading-1">
                {{ __('Job-alert preferences') }}
            </h1>
        </div>
    </section>

    <livewire:job-alert-form :job-alert="$jobAlert"></livewire:job-alert-form>
</x-layouts.app>
