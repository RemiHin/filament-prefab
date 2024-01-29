<?php

namespace App\Filament\Resources\StoryCategoryResource\Pages;

use App\Filament\Resources\StoryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoryCategories extends ListRecords
{
    protected static string $resource = StoryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
