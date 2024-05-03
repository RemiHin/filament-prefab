<?php

namespace App\Filament\Plugins\Blocks;

use App\Filament\Plugins\BaseBlock;
use App\Models\Service;
use Filament\Forms;

class ServiceBlock extends BaseBlock
{
    public static function getType(): string
    {
        return 'service';
    }

    public static function getLabel(): string
    {
        return __('Service');
    }

    public static function getFields(): array
    {
        return [
            Forms\Components\Select::make('service')
                ->label(__('Service'))
                ->required()
                ->options(Service::visible()->pluck('name','id')),
        ];
    }

    public static function factory(): ?array
    {
        return [
            'service' => Service::query()->inRandomOrder()->first()?->id,
        ];
    }

    public function getService(): ?Service
    {
        return Service::query()->firstWhere('id', $this->service);
    }
}
