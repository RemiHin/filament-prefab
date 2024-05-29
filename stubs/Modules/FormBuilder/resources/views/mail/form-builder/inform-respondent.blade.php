<x-mail::message>
# Hallo {{ $name }},

{{ $message }}

Bedankt,<br>
{{ config('app.name') }}
</x-mail::message>
