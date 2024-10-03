@props([
    'title',
    'icon',
    'open' => false,
])

<x-vacancy.search-dropdown
    :title="$title"
    :icon="$icon"
    :open="$open"
>
    <div id="slider" class="mt-6" wire:ignore></div>
</x-vacancy.search-dropdown>

@script
    <script>
        document.addEventListener('livewire:initialized', function (a) {
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
                    'max': 40
                },
            });

            slider.on('change', (values) => {
                @this.set('hoursMin', values[0]);
                @this.set('hoursMax', values[1]);
            });

            @this.on('updated-slider', (min, max) => {
                slider.set([min, max]);
            });
        });
    </script>
@endscript
