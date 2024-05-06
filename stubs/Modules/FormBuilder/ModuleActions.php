<?php

declare(strict_types=1);

namespace RemiHin\FilamentPrefabStubs\Modules\FormBuilder;

use RemiHin\FilamentPrefab\Console\PrefabCommand;

class ModuleActions
{
    public function execute(): void
    {
//        $this->registerRoutes();
        $this->registerBlocks();
        $this->registerHelper();
    }

    protected function registerBlocks(): void
    {

    }

    protected function registerHelper(): void
    {

    }

    protected function registerRoutes(): void
    {
        $prefabCommand = app(PrefabCommand::class);

        $after = <<< 'AFTER'
            // RouteDefinitions
AFTER;

        $new = <<< 'NEW'
                Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
NEW;

        $prefabCommand->addToExistingFile(base_path('routes/web.php'), $new, $after);
    }
}
