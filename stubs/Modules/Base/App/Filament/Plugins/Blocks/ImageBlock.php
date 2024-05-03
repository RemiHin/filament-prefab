<?php

declare(strict_types=1);

namespace App\Filament\Plugins\Blocks;

use Filament\Forms;
use App\Filament\Plugins\BaseBlock;
use Database\Factories\Helpers\FactoryImage;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class ImageBlock extends BaseBlock
{
    public static function getType(): string
    {
        return 'image';
    }

    public static function getLabel(): string
    {
        return __('Image');
    }

    public static function getFields(): array
    {
        return [
            CuratorPicker::make('image')
                ->label(__('Image'))
                ->required(),
        ];
    }

    public static function factory(): ?array
    {
        return [
            'image' => FactoryImage::make()->fileManagerField(),
        ];
    }
}
