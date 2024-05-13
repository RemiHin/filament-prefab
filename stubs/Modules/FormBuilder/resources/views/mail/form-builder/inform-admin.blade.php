<x-mail::message>
# Hallo {{ $name }},

{{ $message }}

<x-mail::button :url="$url">
Bekijk formulier
</x-mail::button>

Bedankt,<br>
{{ config('app.name') }}
</x-mail::message>
