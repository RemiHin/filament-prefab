@php
    $form = $block->getForm();
@endphp

@if($form)
    <section class="mt-10 lg:mt-16 container">
        <x-form-builder :form="$form"/>
    </section>
@endif
