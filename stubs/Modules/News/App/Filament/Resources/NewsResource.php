<?php

namespace App\Filament\Resources;

use App\Filament\Plugins\BlockModule;
use App\Filament\Resources\NewsResource\Pages;
use App\Models\NewsItem;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    protected static ?string $model = NewsItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 40;

    public static function getNavigationGroup(): string
    {
        return __('Modules');
    }

    public static function getLabel(): ?string
    {
        return __('News');
    }

    public static function getPluralLabel(): ?string
    {
        return __('News');
    }

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
                                    urlPath: '/nieuws/',
                                    urlVisitLinkLabel: __('View page'),
                                    titleLabel: __('Name'),
                                    titlePlaceholder: '',
                                    slugLabel: __('Link:'),
                                ),

                                Forms\Components\Toggle::make('visible')
                                    ->label(__('Visible'))
                                    ->default(true)
                                    ->required(),

                                Forms\Components\Textarea::make('intro')
                                    ->label(__('Intro'))
                                    ->maxLength(65535)
                                    ->nullable()
                                    ->string()
                                    ->columnSpanFull(),

                                CuratorPicker::make('image_id')
                                    ->buttonLabel(__('Add image'))
                                    ->label(__('Image')),

                                BlockModule::make('content'),

                                Forms\Components\DatePicker::make('publish_from')
                                    ->label(__('Publish from'))
                                    ->default(today())
                                    ->required()
                                    ->live(onBlur: true),

                                Forms\Components\DatePicker::make('publish_until')
                                    ->label(__('Publish until'))
                                    ->nullable()
                                    ->live(onBlur: true)
                                    ->after('publish_from'),

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
                    ->label(__('Name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label(__('Slug'))
                    ->searchable(),

                Tables\Columns\IconColumn::make('visible')
                    ->label(__('Visible'))
                    ->boolean(),

                Tables\Columns\TextColumn::make('publish_from')
                    ->label(__('Publish from'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('publish_until')
                    ->label(__('Publish until'))
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->label(__('Deleted at'))
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
            'index' => Pages\ListNewsItems::route('/'),
            'create' => Pages\CreateNewsItem::route('/create'),
            'view' => Pages\ViewNewsItem::route('/{record}'),
            'edit' => Pages\EditNewsItem::route('/{record}/edit'),
        ];
    }
}
