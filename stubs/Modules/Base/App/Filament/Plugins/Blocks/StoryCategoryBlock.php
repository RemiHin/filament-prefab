<?php

namespace App\Filament\Plugins\Blocks;

use App\Filament\Plugins\BaseBlock;
use App\Models\StoryCategory;
use Filament\Forms;
use Illuminate\Support\Collection;

class StoryCategoryBlock extends BaseBlock
{
    public static function getType(): string
    {
        return 'story-category';
    }

    public static function getLabel(): string
    {
        return __('Story category');
    }

    public static function getFields(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->label(__('Title'))
                ->required(),

            Forms\Components\Textarea::make('text')
                ->label(__('Text'))
                ->nullable(),

            Forms\Components\Select::make('storyCategory')
                ->label(__('Category'))
                ->required()
                ->options(StoryCategory::whereHas('stories', fn ($builder) => $builder->visible()->published())->pluck('name','id')),
        ];
    }

    public static function factory(): ?array
    {
        return [
            'storyCategory' => StoryCategory::inRandomOrder()->first()?->id,
        ];
    }

    public function getStoryCategory(): ?StoryCategory
    {
        return StoryCategory::query()->firstWhere('id', $this->storyCategory);
    }

    public function getStories(): Collection
    {
        $category = $this->getStoryCategory();

        if (! $category) {
            return collect();
        }

        return $category->stories()->visible()->get();
    }
}
