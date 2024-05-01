<?php

declare(strict_types=1);

namespace App\Facades\CookieConsent;

use DateTimeInterface;
use Symfony\Component\HttpFoundation\Cookie;

interface CookieConsentInterface
{
    public const FUNCTIONAL = 'functional';

    public const ANALYSIS = 'analysis';

    public const TRACKING = 'tracking';

    /**
     * Checks if the user has provided any form of consent.
     *
     * @return bool
     */
    public function hasConsent(): bool;

    /**
     * Returns array of consents given by the user.
     * @return array<string,bool>
     */
    public function getConsent(): array;

    /**
     * Check if user has given consent for the cookie group with the given name.
     *
     * @param string $name
     * @param bool $default
     * @return bool
     */
    public function hasConsentFor(string $name, bool $default = false): bool;

    /**
     * @param array $value
     * @param null|DateTimeInterface $expiresAt
     * @return Cookie
     */
    public function createCookie(array $value, ?DateTimeInterface $expiresAt = null): Cookie;
}
