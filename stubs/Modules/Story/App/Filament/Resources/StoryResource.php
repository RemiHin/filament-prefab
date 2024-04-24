<?php

namespace App\Filament\Resources;

use App\Filament\Blocks\BlockModule;
use App\Filament\Blocks\SeoFields;
use App\Filament\Blocks\OGFields;
use App\Filament\Resources\StoryResource\Pages;
use App\Models\Story;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class StoryResource extends Resource
{
    protected static ?string $model = Story::class;

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

                                Forms\Components\Select::make('story_category_id')
                                    ->relationship('storyCategory', 'name')
                                    ->required(),

                                Forms\Components\Toggle::make('visible')
                                    ->default(true)
                                    ->required(),

                                Forms\Components\Toggle::make('highlighted')
                                    ->default(false)
                                    ->required(),

                                Forms\Components\Textarea::make('intro')
                                    ->maxLength(65535)
                                    ->nullable()
                                    ->string()
                                    ->columnSpanFull(),

                                CuratorPicker::make('image_id')
                                    ->label(__('Image')),

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
            'index' => Pages\ListStories::route('/'),
            'create' => Pages\CreateStory::route('/create'),
            'view' => Pages\ViewStory::route('/{record}'),
            'edit' => Pages\EditStory::route('/{record}/edit'),
        ];
    }
}
