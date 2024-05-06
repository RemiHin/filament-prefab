<?php

namespace App\Filament\Resources;

use App\Filament\Plugins\BlockModule;
use App\Filament\Resources\FormResponseResource\Pages;
use App\Filament\Resources\FormResponseResource\RelationManagers;
use App\Models\FormResponse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormResponseResource extends Resource
{
    protected static ?string $model = FormResponse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function getLabel(): ?string
    {
        return __('Respondent');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Respondent');
    }

    public static function form(Form $form): Form
    {
        $blockFields = [];

        if ($model = $form->getModelInstance()) {
            foreach ($model->form->content as $blockData) {
                $block = BlockModule::reconstructBlock($blockData['type'], $blockData['data']);

                $blockFields[] = Forms\Components\TextInput::make('form_data.' . $block->id . '.answer')
                    ->label($block->getQuestion());
            }
        }

        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->label(__('Respondent'))
                    ->prefix(__('Respondent') . ' ')
                    ->required()
                    ->maxLength(255),

                ...$blockFields,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('form.name')
                    ->label(__('Form')),

                Tables\Columns\TextColumn::make('id')
                    ->label(__('Respondent'))
                    ->prefix(__('Respondent') . ' '),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormResponses::route('/'),
            'view' => Pages\ViewFormResponse::route('/{record}'),
        ];
    }
}
