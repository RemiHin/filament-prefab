<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoryCategoryResource\Pages;
use App\Models\StoryCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoryCategoryResource extends Resource
{
    protected static ?string $model = StoryCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 51;

    public static function getNavigationGroup(): string
    {
        return __('Stories');
    }

    public static function getLabel(): ?string
    {
        return __('Category');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Categories');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->string()
                    ->maxLength(255),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStoryCategories::route('/'),
            'create' => Pages\CreateStoryCategory::route('/create'),
            'view' => Pages\ViewStoryCategory::route('/{record}'),
            'edit' => Pages\EditStoryCategory::route('/{record}/edit'),
        ];
    }
}
