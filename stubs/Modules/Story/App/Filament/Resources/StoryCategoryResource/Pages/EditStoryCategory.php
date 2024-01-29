<?php

namespace App\Filament\Resources\StoryCategoryResource\Pages;

use App\Filament\Resources\StoryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStoryCategory extends EditRecord
{
    protected static string $resource = StoryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
