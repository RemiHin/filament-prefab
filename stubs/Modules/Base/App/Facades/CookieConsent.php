<?php

declare(strict_types=1);

namespace App\Facades;

use App\Facades\CookieConsent\CookieConsentInterface;
use Illuminate\Support\Facades\Facade;

class CookieConsent extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CookieConsentInterface::class;
    }
}
