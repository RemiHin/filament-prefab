<?php

declare(strict_types=1);

namespace App\Filament\Plugins\Blocks;

use Filament\Forms;
use Awcodes\Curator\Models\Media;
use App\Filament\Plugins\BaseBlock;
use Database\Factories\Helpers\FactoryImage;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class TextWithImageBlock extends BaseBlock
{
    public static function getType(): string
    {
        return 'text-with-image';
    }

    public static function getLabel(): string
    {
        return __('Text with image');
    }

    public static function getFields(): array
    {
        return [
            Forms\Components\RichEditor::make('text')
                ->label(__('Text'))
                ->disableToolbarButtons([
                    'attachFiles',
                ])
                ->string()
                ->maxLength(65535)
                ->required(),

            CuratorPicker::make('image')
                ->label(__('Image'))
                ->required(),

            Forms\Components\Radio::make('position')
                ->label(__('Position'))
                ->options([
                    'left' => __('Left'),
                    'right' => __('Right'),
                ])
                ->required()
                ->default('left'),
        ];
    }

    public static function factory(): ?array
    {
        return [
            'text' => sprintf('<p>%s</p>', fake()->paragraph()),
            'image' => FactoryImage::make()->fileManagerField(),
            'position' => fake()->randomElement(['left', 'right']),
        ];
    }
}
