<x-mail::message>
# Hallo {{ $jobAlert->name }},

New vacancies have been found matching your preferences.

<ul>
@foreach($vacancies->take(3) as $vacancy)
<li>
    {{ $vacancy->name }}
</li>
@endforeach
@if($vacancies->count() > 3)
<li>
    {{ __('And another :count vacancies', ['count' => $this->vacancies->count() - 3]) }}
</li>
@endif
</ul>

<x-mail::button :url="url($page->slug)">
    {{ __('View all vacancies') }}
</x-mail::button>

Bedankt,<br>
{{ config('app.name') }}

<x-slot:subcopy>
    [{{  __('Manage preferences') }}]({{ $jobAlert->getPreferencesUrl() }})
    [{{  __('Unsubscribe') }}]({{ $jobAlert->getUnsubscribeUrl() }})
</x-slot:subcopy>

</x-mail::message>
