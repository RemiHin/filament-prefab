<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobAlertResource\Pages;
use App\Filament\Resources\JobAlertResource\RelationManagers;
use App\Models\JobAlert;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobAlertResource extends Resource
{
    protected static ?string $model = JobAlert::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';

    protected static ?int $navigationSort = 110;

    public static function getNavigationGroup(): string
    {
        return __('Vacancies');
    }

    public static function getLabel(): ?string
    {
        return __('Job Alert');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Job Alerts');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                 Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label(__('Email address'))
                    ->required(),

                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('hours_min')
                            ->label(__('Minimum hours'))
                            ->integer()
                            ->required(),

                        Forms\Components\TextInput::make('hours_max')
                            ->label(__('Maximum hours'))
                            ->integer()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email address'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('hours_min')
                    ->label(__('Hours Min'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('hours_max')
                    ->label(__('Hours Max'))
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FiltersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobAlerts::route('/'),
            'create' => Pages\CreateJobAlert::route('/create'),
            'edit' => Pages\EditJobAlert::route('/{record}/edit'),
        ];
    }
}
