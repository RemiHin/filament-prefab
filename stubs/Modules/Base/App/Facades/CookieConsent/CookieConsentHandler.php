<?php

declare(strict_types=1);

namespace App\Facades\CookieConsent;

use Carbon\Carbon;
use JsonException;
use LogicException;
use DateTimeInterface;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Cookie;

class CookieConsentHandler implements CookieConsentInterface
{
    protected ?array $cookie = null;

    /**
     * CookieConsent constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $cookie = $request->cookie(config('cookie-consent.cookie_name', 'cookie_consent'));

        if (! is_string($cookie)) {
            return;
        }

        try {
            $consentArray = json_decode($cookie, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            return;
        }

        $this->cookie = $this->sanitizeCookie($consentArray);
    }

    /**
     * Functional is always true.
     * Functional cookies can always be placed.
     *
     * @return bool
     */
    public function isFunctional(): bool
    {
        return true;
    }

    public function getConsent(): array
    {
        return $this->cookie ?? [];
    }

    public function hasConsent(): bool
    {
        return ! is_null($this->cookie);
    }

    public static function cookieName(): string
    {
        return config('cookie-consent.cookie_name');
    }

    public static function pageLabel(): ?string
    {
        return config('cookie-consent.cookie_page');
    }

    public static function page(): ?Model
    {
        $page = static::pageLabel();

        if (! $page) {
            return null;
        }

        return get_model_for_label($page);
    }

    public function createCookie(array $value, ?DateTimeInterface $expiresAt = null): Cookie
    {
        $expiresAt ??= Carbon::now()->add(config('cookie-consent.cookie_lifetime'));

        $consent = $this->sanitizeCookie($value);

        return Cookie::create(
            config('cookie-consent.cookie_name'),
            json_encode($consent),
            $expiresAt,
            config('cookie-consent.path', '/'),
            config('cookie-consent.domain', null),
            config('cookie-consent.secure', null),
            config('cookie-consent.http-only', true),
        )->withSameSite(config('cookie-consent.same_site'));
    }

    public function hasConsentFor(string $name, bool $default = false): bool
    {
        $method = 'is' . Str::studly($name);
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        if (! $this->hasConsent()) {
            return $default;
        }

        return in_array($name, $this->getConsent());
    }

    protected function sanitizeCookie(array $userConsent): array
    {
        $configCookies = config('cookie-consent.cookie_types', []);

        $sanitizedConsent = [];
        foreach ($configCookies as $cookieName => $options) {
            if ($options['required'] ?? false || in_array($cookieName, $userConsent)) {
                $sanitizedConsent[] = $cookieName;
            }
        }

        return $sanitizedConsent;
    }

    public function __call($name, $arguments)
    {
        if (Str::startsWith($name, 'is')) {
            $consent = Str::snake(Str::after($name, 'is'));

            return $this->hasConsentFor($consent);
        }

        $classname = static::class;

        throw new LogicException("Call to undefined method {$classname}:{$name}.");
    }
}
