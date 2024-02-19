<?php

declare(strict_types=1);

namespace RemiHin\FilamentPrefabStubs\Modules\Service;

use RemiHin\FilamentPrefab\Console\PrefabCommand;

class ModuleActions
{
    public function execute(): void
    {
        $this->registerRoutes();
    }

    protected function registerRoutes(): void
    {
        $prefabCommand = app(PrefabCommand::class);

        $after = <<< 'AFTER'
            // RouteDefinitions
AFTER;

        $new = <<< 'NEW'
                Route::get('/diensten', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/diensten/{service:slug}', [ServiceController::class, 'show'])->name('service.show');
NEW;

        $prefabCommand->addToExistingFile(base_path('routes/web.php'), $new, $after);
    }
}
