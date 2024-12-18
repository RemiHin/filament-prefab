<div class="mb-5">
    <h2 class="mb-8">{{ $form->name }}</h2>

    @if(Session::get('form_success_' . $form->id))
        <div>{{ __('Form submitted successfully') }}</div>
    @else
        <form action="{{ route('form.submit', ['form' => $form]) }}" method="post" enctype="multipart/form-data">
            @csrf

            <x-blocks :blocks="$form->content" />

            <x-button :title="__('Submit')" type="submit" />
        </form>
    @endif
</div>
