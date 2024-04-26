<?php

declare(strict_types=1);

use App\Facades\CookieConsent\CookieConsentInterface;

return [
    'title' => 'Hoi! Wij gebruiken cookies.',

    'description' => <<<'DESCRIPTION'
        Door op 'Alles toestaan' te klikken, accepteer je alle cookies (en vergelijkbare technieken) op onze website.
        Hiermee kunnen wij en derden jouw internetgedrag op onze website volgen en verwerken.
        Door ons en derden kan een profiel worden gemaakt waarmee gepersonaliseerde advertenties kunnen worden getoond.
        Door op 'instellingen wijzigen' te klikken, kun je een andere cookie voorkeur kiezen.
    DESCRIPTION,

    'button' => [
        'save' => 'Opslaan',
        'accept-all' => 'Alles toestaan',
        'preferences' => 'Voorkeuren',
        'more-info' => 'Meer informatie over de cookies',
    ],

    'required' => ':name zijn altijd verplicht.',

    CookieConsentInterface::FUNCTIONAL => [
        'name' => 'Functionele cookies',
        'description' => 'Functionele cookies die zorgen voor een goed werkende website.',
    ],
    CookieConsentInterface::ANALYSIS => [
        'name' => 'Analytische cookies',
        'description' => 'Analytische cookies die zorgen voor een goed werkende website. Jouw internetgedrag wordt gedeeld met :website.',
    ],
    CookieConsentInterface::TRACKING => [
        'name' => 'Tracking cookies',
        'description' => 'Tracking cookies die zorgen voor een goed werkende website. Jouw internetgedrag wordt gedeeld met :website en derden die cookies plaatsen.',
    ],
];
