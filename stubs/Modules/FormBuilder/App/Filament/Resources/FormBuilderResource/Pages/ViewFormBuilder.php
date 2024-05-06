<?php

namespace App\Filament\Resources\FormBuilderResource\Pages;

use App\Filament\Resources\FormBuilderResource;
use App\Filament\Resources\FormBuilderResource\RelationManagers\FormResponsesRelationManager;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;

class ViewFormBuilder extends ViewRecord
{
    protected static string $resource = FormBuilderResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getRelationManagers(): array
    {
        return [
            FormResponsesRelationManager::class,
        ];
    }
}
