<?php

declare(strict_types=1);

namespace App\Providers;

use App\Facades\CookieConsent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cookie\Middleware\EncryptCookies;

use function App\Providers\asset;

class CookieConsentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::directive('cookieConsent', function () {
            return "<?php echo View::make('cookie-consent.banner')->render(); ?>";
        });

        Blade::directive('cookieConsentForm', function () {
            return "<?php echo View::make('cookie-consent.page-form')->render(); ?>";
        });

        Blade::directive('cookieConsentCss', function () {
            $path = asset('vendor/liberiser/cookie-consent.css');

            return "<link rel='stylesheet' type='text/css' href='{$path}'>";
        });
    }

    public function register(): void
    {
        $this->app->bind(CookieConsent\CookieConsentInterface::class, CookieConsent\CookieConsentHandler::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('CookieConsent', CookieConsent::class);

        $this->app->afterResolving(
            EncryptCookies::class,
            fn (EncryptCookies $cookies) => $cookies->disableFor(CookieConsent::cookieName())
        );
    }
}
