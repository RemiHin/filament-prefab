<?php

namespace App\Filament\Resources;

use App\Filament\Blocks\BlockModule;
use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

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
                                    urlPath: '/blog/',
                                    urlVisitLinkLabel: __('View page'),
                                    titleLabel: __('Name'),
                                    titlePlaceholder: '',
                                    slugLabel: __('Link:'),
                                ),

                                Forms\Components\Toggle::make('visible')
                                    ->default(true)
                                    ->required(),

                                Forms\Components\Textarea::make('intro')
                                    ->maxLength(65535)
                                    ->nullable()
                                    ->string()
                                    ->columnSpanFull(),

                                CuratorPicker::make('image_id')
                                    ->label(__('Image'))
                                    ->required(),

                                BlockModule::make('content'),

                                Forms\Components\DatePicker::make('publish_from')
                                    ->required()
                                    ->live(onBlur: true),

                                Forms\Components\DatePicker::make('publish_until')
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('visible')
                    ->boolean(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\ImageColumn::make('image_alt'),
                Tables\Columns\TextColumn::make('publish_from')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('publish_until')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'view' => Pages\ViewBlog::route('/{record}'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
