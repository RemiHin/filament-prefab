<?php

declare(strict_types=1);

namespace App\Filament\Plugins\Blocks;

use App\Filament\Plugins\BaseBlock;
use App\Models\NewsItem;
use Filament\Forms;

class NewsBlock extends BaseBlock
{
    public static function getType(): string
    {
        return 'news';
    }

    public static function getLabel(): string
    {
        return __('News');
    }

    public static function getFields(): array
    {
        return [
            Forms\Components\Select::make('news_item')
                ->label(__('News'))
                ->required()
                ->options(NewsItem::visible()->published()->pluck('name','id')),
        ];
    }

    public static function factory(): ?array
    {
        return [
            'news_item' => NewsItem::visible()->published()->inRandomOrder()->first()?->id,
        ];
    }

    public function getNewsItem(): ?NewsItem
    {
        return NewsItem::visible()->published()->firstWhere('id', $this->news_item);
    }
}
