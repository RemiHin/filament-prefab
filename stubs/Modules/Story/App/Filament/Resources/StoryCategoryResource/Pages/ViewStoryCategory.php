<?php

namespace App\Filament\Resources\StoryCategoryResource\Pages;

use App\Filament\Resources\StoryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStoryCategory extends ViewRecord
{
    protected static string $resource = StoryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
