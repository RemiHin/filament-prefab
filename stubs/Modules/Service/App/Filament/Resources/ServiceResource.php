<?php

namespace App\Filament\Resources;

use App\Filament\Blocks\BlockModule;
use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                                TitleWithSlugInput::make(
                                    fieldTitle: 'name',
                                    fieldSlug: 'slug',
                                    urlPath: '/diensten/',
                                    urlVisitLinkLabel: __('View page'),
                                    titleLabel: __('Name'),
                                    titlePlaceholder: '',
                                    slugLabel: __('Link:'),
                                ),

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

                                CuratorPicker::make('image_id')
                                    ->label(__('Image')),

                                BlockModule::make('content'),

                            ]),
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                static::$model::seoFields(),
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
