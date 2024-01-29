<?php

declare(strict_types=1);

namespace RemiHin\FilamentPrefabStubs\Modules\News;

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
                Route::get('/nieuws', [NewsController::class, 'index'])->name('news.index');
        Route::get('/nieuws/{newsItem:slug}', [NewsController::class, 'show'])->name('news.show');
NEW;

        $prefabCommand->addToExistingFile(base_path('routes/web.php'), $new, $after);
    }
}
