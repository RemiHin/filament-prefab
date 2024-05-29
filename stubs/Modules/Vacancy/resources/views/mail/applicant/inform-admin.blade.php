<x-mail::message>
# Hallo,

Nieuwe sollicitatie inzending van {{ $applicant->name }} voor {{ $applicant->vacancy->name }}:

<ul>
    <li>{{ $applicant->email }}</li>
    <li>{{ $applicant->phone }}</li>
    <li>{{ $applicant->motivation }}</li>
</ul>

<x-mail::button :url="route('filament.admin.resources.applicants.view', ['record' => $applicant])">
Bekijk sollicitant @if($applicant->cv) en CV @endif
</x-mail::button>

Bedankt,<br>
{{ config('app.name') }}
</x-mail::message>
