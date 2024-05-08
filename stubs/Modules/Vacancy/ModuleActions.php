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
//        $this->addObserverToProvider();
//        $this->addCvDrive();
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

//    public function addCvDrive(): void
//    {
//        /** @var PrefabCommand $prefabCommand */
//        $prefabCommand = app(PrefabCommand::class);
//
//        $file = config_path('filesystems.php');
//
//        $drive = PHP_EOL
//            . "        'cv' => [" . PHP_EOL
//            . "            'driver' => 'local'," . PHP_EOL
//            . "            'root' => storage_path('app/cv')," . PHP_EOL
//            . "            'url' => env('APP_URL') . '/cv'," . PHP_EOL
//            . "        ]," . PHP_EOL;
//
//        $after = "        'public' => [" . PHP_EOL
//            . "            'driver' => 'local'," . PHP_EOL
//            . "            'root' => storage_path('app/public')," . PHP_EOL
//            . "            'url' => env('APP_URL') . '/storage'," . PHP_EOL
//            . "            'visibility' => 'public'," . PHP_EOL
//            . "        ]," . PHP_EOL;
//
//        $prefabCommand->addToExistingFile(
//            $file,
//            $drive,
//            $after,
//        );
//    }

//    protected function addObserverToProvider(): void
//    {
//        $file = app_path('Providers/EventServiceProvider.php');
//
//        /** @var PrefabCommand $prefabCommand */
//        $prefabCommand = app(PrefabCommand::class);
//
//        $prefabCommand->addToExistingFile(
//            $file,
//            '        Applicant::observe(ApplicantObserver::class);',
//            'public function boot(): void'.PHP_EOL.'    {',
//        );
//
//        $prefabCommand->addToExistingFile(
//            $file,
//            'use App\Models\Applicant;'.PHP_EOL.'use App\Observers\ApplicantObserver;',
//            'namespace App\Providers;'.PHP_EOL,
//        );
//    }
}
