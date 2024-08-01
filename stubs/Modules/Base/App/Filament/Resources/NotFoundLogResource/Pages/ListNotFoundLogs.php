<?php

namespace App\Filament\Resources\NotFoundLogResource\Pages;

use App\Filament\Resources\NotFoundLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotFoundLogs extends ListRecords
{
    protected static string $resource = NotFoundLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
