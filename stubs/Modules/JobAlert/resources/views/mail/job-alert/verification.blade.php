<x-mail::message>
# Hallo {{ $jobAlert->name }},

Bedankt voor het inschrijven voor de job alert. Met onderstaande knop kunt u uw e-mail bevestigen zodat u op de hoogte blijft van onze vacatures die bij u passen.

<x-mail::button :url="$jobAlert->getVerificationUrl()">
Bevestigen
</x-mail::button>

Bedankt,<br>
{{ config('app.name') }}
</x-mail::message>
