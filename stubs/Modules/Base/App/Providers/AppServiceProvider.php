<?php

namespace App\Providers;

use App\Settings\ContactSettings;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Observers\UserObserver;
use Database\Factories\Helpers\BlockFactoryHandler;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use RemiHin\FilamentPrefabStubs\Modules\Base\App\Settings\GoogleSettings;

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
                'googleSettings' => app(GoogleSettings::class),
            ]);
        });

        User::observe(UserObserver::class);

        Event::listen(function (CommandFinished $command) {
            if ($command->command === 'db:seed') {
                app(BlockFactoryHandler::class)->execute();
            }
        });
    }
}
