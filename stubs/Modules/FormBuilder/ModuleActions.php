<?php

declare(strict_types=1);

namespace RemiHin\FilamentPrefabStubs\Modules\FormBuilder;

use RemiHin\FilamentPrefab\Console\PrefabCommand;

class ModuleActions
{
    public function execute(): void
    {
        $this->registerBlocks();
        $this->registerHelper();
    }

    protected function registerBlocks(): void
    {
        $blocks = <<< 'Blocks'

    'form' => [
        \App\Filament\Plugins\Blocks\Input\TextInputBlock::class,
        \App\Filament\Plugins\Blocks\Input\EmailInputBlock::class,
        \App\Filament\Plugins\Blocks\Input\TextAreaInputBlock::class,
    ],
Blocks;

        (new PrefabCommand())->addToExistingFile(
            config_path('blocks.php'),
            $blocks,
            '];',
            'before',
        );
    }

    protected function registerHelper(): void
    {
        $helper = <<< 'Helper'

if (! function_exists('get_form_builder_options')) {
    function get_form_builder_options(array $formData, array $fieldTypes): \Illuminate\Support\Collection
    {
        return collect($formData)
            ->filter(fn (mixed $block) => is_array($block) && array_key_exists('type', $block))
            ->filter(fn (array $block) => ! empty($block['data']['title']) && in_array($block['type'], $fieldTypes))
            ->mapWithKeys(fn(array $block, $key) => [$block['data']['id'] => $block['data']['title']]);
    }
}
Helper;

        (new PrefabCommand())->addToExistingFile(
            base_path('app/Helpers/helpers.php'),
            $helper
        );
    }
}
