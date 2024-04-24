@php /** @var \App\Models\Employee $employee */ @endphp

@props([
    'employee',
])

<div {{ $attributes->merge(['class' => 'flex flex-col-reverse rounded-lg bg-primary-light p-4']) }}>
    <div class="w-full">
        <div class="heading-6 text-primary-dark w-full text-center mb-2">{{ $employee->name }}</div>
        <div class="text-primary-dark text-sm w-full text-center">{{ $employee->function }}</div>
    </div>

    <div class="w-full mb-4">
        <figure class="relative w-full h-0 pb-[100%] rounded overflow-hidden">
            <img
                src="{{ $employee->image?->getSignedUrl() ?? asset('assets/images/fallback-employee.svg') }}"
                alt="{{ $employee->name }}"
                class="absolute h-full w-full object-cover"
                loading="lazy"
            >
        </figure>
    </div>
</div>
