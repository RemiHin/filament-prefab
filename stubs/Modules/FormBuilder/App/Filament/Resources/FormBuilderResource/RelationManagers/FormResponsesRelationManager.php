<?php

namespace App\Filament\Resources\FormBuilderResource\RelationManagers;

use App\Filament\Plugins\BlockModule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormResponsesRelationManager extends RelationManager
{
    protected static string $relationship = 'formResponses';

    public function form(Form $form): Form
    {
        $blockFields = [];

        foreach ($this->ownerRecord->content as $id => $blockData) {
            $block = BlockModule::reconstructBlock($blockData['type'], $blockData['data']);

            $blockFields[] = Forms\Components\TextInput::make('form_data.' . $block->id . '.answer')
                ->label($block->getQuestion());
        }

        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->prefix(__('Respondent') . ' ')
                    ->required()
                    ->maxLength(255),

                ...$blockFields,
            ]);
    }

    public function table(Table $table): Table
    {
        $blockColumns = [];

        foreach ($this->ownerRecord->content as $id => $blockData) {
            $block = BlockModule::reconstructBlock($blockData['type'], $blockData['data']);

            $blockColumns[] = Tables\Columns\TextColumn::make('form_data.' . $block->id . '.answer')
                ->label($block->getQuestion())
                ->searchable();
        }

        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->prefix(__('Respondent') . ' ')
                    ->searchable(),

                ...$blockColumns,

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->date()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
