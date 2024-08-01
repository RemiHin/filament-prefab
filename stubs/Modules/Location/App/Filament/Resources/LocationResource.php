<?php

namespace App\Filament\Resources;

use App\Filament\Plugins\BlockModule;
use App\Filament\Resources\LocationResource\Pages;
use App\Filament\Resources\LocationResource\RelationManagers;
use App\Models\Location;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 90;

    public static function getNavigationGroup(): string
    {
        return __('Modules');
    }

    public static function getLabel(): ?string
    {
        return __('Location');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Locations');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->schema([
                                TitleWithSlugInput::make(
                                    fieldTitle: 'name',
                                    fieldSlug: 'slug',
                                    urlVisitLinkLabel: __('View page'),
                                    titleLabel: __('Name'),
                                    titlePlaceholder: '',
                                    slugLabel: __('Link:'),
                                ),

                                Forms\Components\Toggle::make('visible')
                                    ->label(__('Visible'))
                                    ->default(true),

                                Forms\Components\Textarea::make('intro')
                                    ->label(__('Intro'))
                                    ->rows(5)
                                    ->nullable(),

                                BlockModule::make('content'),

                                CuratorPicker::make('image_id')
                                    ->label(__('Image'))
                                    ->buttonLabel(__('Add image'))
                                    ->label(__('Image'))
                                    ->required(),

                                Forms\Components\TextInput::make('phone')
                                    ->label(__('Phone'))
                                    ->rules(['phone:NL'])
                                    ->nullable(),

                                Forms\Components\TextInput::make('email')
                                    ->label(__('Email'))
                                    ->nullable()
                                    ->email(),

                                Forms\Components\TextInput::make('street')
                                    ->label(__('Street'))
                                    ->required(),

                                Forms\Components\TextInput::make('house_number')
                                    ->label(__('House Number'))
                                    ->required(),

                                Forms\Components\TextInput::make('postal_code')
                                    ->label(__('Postal Code'))
                                    ->rules(['postal_code:NL'])
                                    ->required(),

                                Forms\Components\TextInput::make('city')
                                    ->label(__('City'))
                                    ->required(),
                            ]),

                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                static::$model::seoFields(),
                            ]),
                    ]),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
