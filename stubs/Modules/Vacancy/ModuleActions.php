<?php

declare(strict_types=1);

namespace RemiHin\FilamentPrefabStubs\Modules\Vacancy;

use RemiHin\FilamentPrefab\Console\PrefabCommand;

class ModuleActions
{
    public function execute(): void
    {
        $this->addNoUISlider();
        $this->addRelationToLocation();
        $this->registerDiskDrive();
    }

    protected function addNoUISlider(): void
    {
        // CSS
        $cssFile = resource_path('css/components.css');

        /** @var PrefabCommand $prefabCommand */
        $prefabCommand = app(PrefabCommand::class);

        $prefabCommand->addToExistingFile(
            $cssFile,
            '@import "components/nouislider.css";',
            '@import "components/swiper.css";',
        );

        // JS
        $jsFile = resource_path('js/app.js');

        /** @var PrefabCommand $prefabCommand */
        $prefabCommand = app(PrefabCommand::class);

        $lines = <<<'LINES'

import noUiSlider from "nouislider";
import wNumb from 'wnumb'

window.noUiSlider = noUiSlider;
window.wNumb = wNumb;
LINES;

        $prefabCommand->addToExistingFile(
            $jsFile,
            $lines,
            "import './components/scroll-to-error';",
        );
    }

    protected function addRelationToLocation(): void
    {
        $file = app_path('Models/Location.php');

        /** @var PrefabCommand $prefabCommand */
        $prefabCommand = app(PrefabCommand::class);

        $prefabCommand->addToExistingFile(
            $file,
            'use Illuminate\Database\Eloquent\Relations\HasMany;',
            'use Illuminate\Database\Eloquent\Relations\BelongsTo;',
        );

        $relation = <<<'RELATION'


    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }
RELATION;

        $prefabCommand->addToExistingFile(
            $file,
            $relation,
            PHP_EOL . '}',
            'before'
        );
    }

    protected function registerDiskDrive(): void
    {
        $filesystem = <<< 'Filesystem'
        'cv' => [
            'driver' => 'local',
            'root' => storage_path('app/cv'),
            'visibility' => 'private',
        ],
        
Filesystem;

        $provider = <<< 'Provider'
        \Illuminate\Support\Facades\Storage::disk('cv')->buildTemporaryUrlsUsing(function ($path, $expiration, $options) {
            return \Illuminate\Support\Facades\URL::temporarySignedRoute(
                'vacancy.download-cv',
                $expiration,
                array_merge($options, ['path' => $path])
            );
        });
        
Provider;

        (new PrefabCommand())->addToExistingFile(
            config_path('filesystems.php'),
            $filesystem,
            "'disks' => ["
        );

        (new PrefabCommand())->addToExistingFile(
            base_path('app/Providers/AppServiceProvider.php'),
            $provider,
            "    public function boot(): void" . PHP_EOL . "    {"
        );
    }
}
