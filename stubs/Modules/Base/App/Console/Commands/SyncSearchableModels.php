<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Elastic\Adapter\Indices\Index;
use Elastic\Adapter\Indices\IndexManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SyncSearchableModels extends Command
{
    protected $signature = 'search:sync {--update-mapping}';

    protected $description = 'Sync all searchable models with the search server.';

    public function handle(): void
    {
        $manager = app(IndexManager::class);

        $updateMapping = false;

        if ($this->option('update-mapping')) {
            $updateMapping = $this->confirm('Are you sure you want to update mapping? This might require you to define custom mapping for modules', true);
        }

        foreach (config('searchable.models') as $searchableModel => $config) {
            $indexName = (new $searchableModel())->searchableAs();

            // If mapping needs to be updated, recreate index to avoid conflicts
            if ($updateMapping) {
                if ($manager->exists($indexName)) {
                    $manager->drop($indexName);
                }
            }

            // If index does not exist create it, else flush existing data
            if (! $manager->exists($indexName)) {
                $indexBlueprint = new Index($indexName);

                $manager->create($indexBlueprint);

                // If model has the method `getElasticMapping` use that to set the mapping instead of the default
                if (method_exists($searchableModel, 'getElasticMapping')) {
                    $manager->putMapping($indexName, $searchableModel::getElasticMapping());
                }
            } else {
                Artisan::call(sprintf(
                    'scout:flush "%s"',
                    addslashes($searchableModel),
                ));
            }

            Artisan::call(sprintf(
                'scout:import "%s"',
                addslashes($searchableModel)
            ));

            $this->info(sprintf(
                'Imported model: %s',
                $searchableModel
            ));
        }
    }
}
