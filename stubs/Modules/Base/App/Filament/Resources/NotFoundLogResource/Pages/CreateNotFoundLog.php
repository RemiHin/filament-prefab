<?php

namespace App\Filament\Resources\NotFoundLogResource\Pages;

use App\Filament\Resources\NotFoundLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNotFoundLog extends CreateRecord
{
    protected static string $resource = NotFoundLogResource::class;
}
