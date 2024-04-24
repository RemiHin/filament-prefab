<?php

namespace App\Filament\Resources;

use App\Filament\Blocks\BlockModule;
use App\Filament\Blocks\SeoFields;
use App\Filament\Blocks\OGFields;
use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->string()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set, $state) {
                                        $set('slug', Str::slug($state));
                                    })
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('slug')
                                    ->hint('Pas dit alleen aan als je specifiek bezig bent met SEO')
                                    ->required()
                                    ->maxLength(255)
                                    ->rules(['alpha_dash'])
                                    ->unique(ignoreRecord: true),

                                Forms\Components\TextInput::make('subtitle')
                                    ->nullable()
                                    ->string()
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('intro')
                                    ->maxLength(65535)
                                    ->nullable()
                                    ->string()
                                    ->columnSpanFull(),

                                Forms\Components\RichEditor::make('description')
                                    ->maxLength(65535)
                                    ->nullable()
                                    ->string()
                                    ->columnSpanFull(),

                                Forms\Components\Toggle::make('visible')
                                    ->default(true)
                                    ->required(),

                                CuratorPicker::make('image_id'),

                                BlockModule::make('content'),

                            ]),
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                SeoFields::make(),

                                OGFields::make()
                            ]),
                    ])
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('visible')
                    ->boolean(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'view' => Pages\ViewService::route('/{record}'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
