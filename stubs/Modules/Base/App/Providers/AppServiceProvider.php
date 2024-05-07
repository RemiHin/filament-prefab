<?php

namespace App\Providers;

use Database\Factories\Helpers\BlockFactoryHandler;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Support\Facades\Event;
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
        Event::listen(function (CommandFinished $command) {
            if ($command->command === 'db:seed') {
                app(BlockFactoryHandler::class)->execute();
            }
        });
    }
}
