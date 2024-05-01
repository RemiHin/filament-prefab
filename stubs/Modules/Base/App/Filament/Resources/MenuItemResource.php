<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\NewsItem;
use App\Models\MenuItem;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-center-left';

    protected static ?int $navigationSort = 11;

    public static function getNavigationGroup(): string
    {
        return __('Manage');
    }

    public static function getLabel(): ?string
    {
        return __('Menu item');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Menu items');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('menu_id')
                    ->relationship('menu', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('menuable_type')
                    ->label('Type')
                    ->required()
                    ->live()
                    ->options([Page::class => 'Pagina', NewsItem::class => 'Blog', 'Empty' => 'Hoofditem zonder link']),

                Forms\Components\Select::make('menuable_id')
                    ->label('Link')
                    ->requiredUnless('menuable_type', 'Empty')
                    ->dehydrateStateUsing(function (Get $get, $state) {
                        if ($get('menuable_type') == 'Empty' && is_null($state)) {
                            return 0;
                        }

                        return $state;
                    })
                    ->live()
                    ->disabled(fn(Get $get) => $get('menuable_type') != Page::class && $get('menuable_type') != NewsItem::class&& $get('menuable_type') != 'Empty')
                    ->options(fn(Get $get) => $get('menuable_type') == Page::class ? Page::pluck('name', 'id') : ($get('menuable_type') == NewsItem::class ? NewsItem::pluck('name', 'id') : []))

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('menu.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('menuable_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('menuable_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'view' => Pages\ViewMenuItem::route('/{record}'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
