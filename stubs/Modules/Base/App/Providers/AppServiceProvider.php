<?php

namespace App\Providers;

use App\Settings\ContactSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function (\Illuminate\Contracts\View\View $view) {
            $view->with([
                'contactSettings' => app(ContactSettings::class),
            ]);
        });
    }
}
