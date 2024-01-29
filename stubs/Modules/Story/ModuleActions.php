<?php

declare(strict_types=1);

namespace RemiHin\FilamentPrefabStubs\Modules\Story;

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
                Route::get('/verhalen', [StoryController::class, 'index'])->name('story.index');
        Route::get('/verhalen/{story:slug}', [StoryController::class, 'show'])->name('story.show');
NEW;

        $prefabCommand->addToExistingFile(base_path('routes/web.php'), $new, $after);
    }
}
