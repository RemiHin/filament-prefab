<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotFoundLogResource\Pages;
use App\Filament\Resources\NotFoundLogResource\RelationManagers;
use App\Models\NotFoundLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotFoundLogResource extends Resource
{
    protected static ?string $model = NotFoundLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('Not found logs');
    }

    public static function getLabel(): ?string
    {
        return __('Not found log');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Not found logs');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('latest_occurrence', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('path')
                    ->label(__('Path'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('latest_occurrence')
                    ->label(__('Last occurrence'))
                    ->sortable()
                    ->dateTime(),

                Tables\Columns\TextColumn::make('count')
                    ->label(__('Amount of times'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
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
            'index' => Pages\ListNotFoundLogs::route('/'),
        ];
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
