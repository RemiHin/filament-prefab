<?php

namespace App\Filament\Resources\PositionGroupResource\Pages;

use App\Filament\Resources\PositionGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPositionGroup extends EditRecord
{
    protected static string $resource = PositionGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
