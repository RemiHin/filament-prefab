@php
$employee = \App\Models\Employee::find($block['data']['employee']);
@endphp
@if($employee)
<div class="{{ $type }} flex flex-col w-full max-w-[900px] px-5 mx-auto mt-10 lg:mt-12">
    <div class="flex flex-col-reverse md:flex-row-reverse md:items-center p-1 gap-5 border-2 border-secondary rounded-lg md:rounded-full">
        <div class="w-full flex flex-col md:self-center gap-3 px-3 py-3 md:py-0 md:px-5 lg:px-10">
            <p class="font-heading font-bold text-4xl">
                {{ $employee->name }}
            </p>

            <div>
                <span class="border px-5 py-0.5 inline-flex border-secondary rounded-full text-secondary bg-secondary-light">
                    {{ $employee->function }}
                </span>
            </div>

            @if($employee->intro)
                <div class="editor">
                    {{ $employee->intro }}
                </div>
            @endif
        </div>

        @if(!is_null($employee->image))
            <x-curator-glider :media="$employee->image" />
        @endif
    </div>
</div>
@endif
