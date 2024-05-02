<?php

declare(strict_types=1);

namespace App\Filament\Plugins\Blocks;

use App\Filament\Plugins\BaseBlock;
use App\Models\Story;
use Filament\Forms;

class StoryBlock extends BaseBlock
{
    public static function getType(): string
    {
        return 'story';
    }

    public static function getLabel(): string
    {
        return __('Story');
    }

    public static function getFields(): array
    {
        return [
            Forms\Components\Select::make('story')
                ->label(__('Story'))
                ->required()
                ->options(Story::visible()->published()->pluck('name','id')),
        ];
    }

    public static function factory(): ?array
    {
        return [
            'story' => Story::visible()->published()->inRandomOrder()->first()?->id,
        ];
    }

    public function getStory(): ?Story
    {
        return Story::visible()->published()->firstWhere('id', $this->story);
    }
}
