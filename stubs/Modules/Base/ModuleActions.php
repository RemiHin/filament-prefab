<?php

declare(strict_types=1);

namespace RemiHin\FilamentPrefabStubs\Modules\Base;

use RemiHin\FilamentPrefab\Console\PrefabCommand;

class ModuleActions
{
    public function execute(): void
    {
        $this->addMailConfig();
        $this->registerDiskDrive();
    }

    protected function addMailConfig(): void
    {
        $prefabCommand = app(PrefabCommand::class);

        $prefabCommand->addToExistingFile(
            config_path('mail.php'),
            PHP_EOL . PHP_EOL . "    'log_mails' => true,",
            PHP_EOL . '];',
            'before'
        );
    }

    protected function registerDiskDrive(): void
    {
        $filesystem = <<< 'Filesystem'
        'tmp-for-tests' => [
            'driver' => 'local',
            'root' => storage_path('app/livewire-tmp'),
        ],    
Filesystem;

        (new PrefabCommand())->addToExistingFile(
            config_path('filesystems.php'),
            $filesystem,
            "'disks' => ["
        );
    }
}
