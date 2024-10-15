<?php

declare(strict_types=1);

namespace RemiHin\FilamentPrefabStubs\Modules\Base;

use RemiHin\FilamentPrefab\Console\PrefabCommand;

class ModuleActions
{
    public function execute(): void
    {
        $this->addMailConfig();
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
}
