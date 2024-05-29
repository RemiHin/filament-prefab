<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PositionGroupResource\Pages;
use App\Filament\Resources\PositionGroupResource\RelationManagers;
use App\Models\PositionGroup;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PositionGroupResource extends Resource
{
    protected static ?string $model = PositionGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?int $navigationSort = 105;

    public static function getNavigationGroup(): string
    {
        return __('Vacancies');
    }

    public static function getLabel(): ?string
    {
        return __('Position Group');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Position Groups');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->label(__('General'))
                            ->schema([
                                TitleWithSlugInput::make(
                                    fieldTitle: 'name',
                                    fieldSlug: 'slug',
                                    urlVisitLinkLabel: __('View page'),
                                    titleLabel: __('Name'),
                                    titlePlaceholder: '',
                                    slugLabel: __('Link:'),
                                ),
                            ]),

                        Forms\Components\Tabs\Tab::make('SEO')
                            ->label(__('SEO'))
                            ->schema([
                                static::$model::seoFields(),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
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
            RelationManagers\PositionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPositionGroups::route('/'),
            'create' => Pages\CreatePositionGroup::route('/create'),
            'edit' => Pages\EditPositionGroup::route('/{record}/edit'),
        ];
    }
}
