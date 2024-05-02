<?php

declare(strict_types=1);

use App\Facades\CookieConsent\CookieConsentInterface;

return [

    /*
    |--------------------------------------------------------------------------
    | Cookie consent page
    |--------------------------------------------------------------------------
    |
    | Most websites provide a page which explains all cookies used on the website.
    | Using this config will add a link within the notification to the specified page.
    | The value inserted here is the label used by the cookie consent page.
    |
    */
    'cookie_page' => 'cookies',

    /*
    |--------------------------------------------------------------------------
    | Website name
    |--------------------------------------------------------------------------
    |
    | The cookie notification has a default text, the website name will be pre-filled.
    |
    */
    'website_name' => env('COOKIE_CONSENT_WEBSITE_NAME', config('app.name')),

    /*
    |--------------------------------------------------------------------------
    | Cookie name
    |--------------------------------------------------------------------------
    |
    | The string value of the name of the cookie.
    |
    */
    'cookie_name' => 'cookie_consent',

    /*
    |--------------------------------------------------------------------------
    | Cookie lifetime
    |--------------------------------------------------------------------------
    |
    | The lifetime of the consent cookie.
    | The time is in ISO notation (P1Y is one year)
    |
    */
    'cookie_lifetime' => 'P1Y',

    /*
    |--------------------------------------------------------------------------
    | Cookies path
    |--------------------------------------------------------------------------
    |
    | The path on the server in which the cookie will be available on.
    |
    | Supported: string
    |
    */
    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Cookies path
    |--------------------------------------------------------------------------
    |
    | The path on the server in which the cookie will be available on.
    |
    | Supported: string|null
    |
    */
    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Cookie Secure
    |--------------------------------------------------------------------------
    |
    | Whether the client should send back the cookie only over HTTPS or
    | null to auto-enable this when the request is already using HTTPS.
    |
    | Supported: bool|string
    |
    */
    'secure' => null,

    /*
    |--------------------------------------------------------------------------
    | Cookie Http Only
    |--------------------------------------------------------------------------
    |
    | Whether the cookie will be made accessible only through the HTTP protocol.
    |
    | Supported: bool
    |
    */
    'http-only' => true,

    /*
    |--------------------------------------------------------------------------
    | Same-Site Cookies
    |--------------------------------------------------------------------------
    |
    | This option determines how your cookies behave when cross-site requests
    | take place, and can be used to mitigate CSRF attacks. By default, we
    | will set this value to "lax" since this is a secure default value.
    |
    | Supported: "lax", "strict", "none", null
    |
    */
    'same_site' => 'lax',

    /*
    |--------------------------------------------------------------------------
    | Cookie types
    |--------------------------------------------------------------------------
    |
    | The supported cookie types with their default checked values.
    | Don't forget to update your language files.
    |
    */
    'cookie_types' => [
        CookieConsentInterface::FUNCTIONAL => [
            'default_checked' => true,
            'required' => true,
        ],
        CookieConsentInterface::ANALYSIS => [
            'default_checked' => false,
        ],
        CookieConsentInterface::TRACKING => [
            'default_checked' => false,
        ],
    ],
];
