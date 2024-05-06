<?php

namespace App\Filament\Resources\FormbuilderResource\Pages;

use App\Filament\Resources\FormBuilderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormbuilders extends ListRecords
{
    protected static string $resource = FormBuilderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
