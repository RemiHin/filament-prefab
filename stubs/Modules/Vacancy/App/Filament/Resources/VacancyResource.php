<?php

namespace App\Filament\Resources;

use App\Filament\Plugins\BlockModule;
use App\Filament\Resources\VacancyResource\Pages;
use App\Filament\Resources\VacancyResource\RelationManagers;
use App\Models\Vacancy;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VacancyResource extends Resource
{
    protected static ?string $model = Vacancy::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 100;

    public static function getNavigationGroup(): string
    {
        return __('Vacancies');
    }

    public static function getLabel(): ?string
    {
        return __('Vacancy');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Vacancies');
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
                                Forms\Components\Fieldset::make('base')
                                    ->columns(1)
                                    ->label(__('General'))
                                    ->schema([
                                        TitleWithSlugInput::make(
                                            fieldTitle: 'name',
                                            fieldSlug: 'slug',
                                            urlPath: '/vacatures/',
                                            urlVisitLinkLabel: __('View page'),
                                            titleLabel: __('Name'),
                                            titlePlaceholder: '',
                                            slugLabel: __('Link:'),
                                        ),

                                        Forms\Components\Textarea::make('intro')
                                            ->label(__('Intro'))
                                            ->nullable(),

                                        BlockModule::make('content'),
                                    ]),

                                Forms\Components\Fieldset::make('visibility')
                                    ->columns(1)
                                    ->label(__('Visibility'))
                                    ->schema([
                                        Forms\Components\Toggle::make('visible')
                                            ->label(__('Visible'))
                                            ->default(true),

                                        Forms\Components\DatePicker::make('publish_from')
                                            ->default(today())
                                            ->label(__('Publish from'))
                                            ->required()
                                            ->live(onBlur: true),

                                        Forms\Components\DatePicker::make('publish_until')
                                            ->label(__('Publish until'))
                                            ->nullable()
                                            ->live(onBlur: true)
                                            ->after('publish_from'),
                                    ]),

                                Forms\Components\Fieldset::make('related')
                                    ->label(__('Related'))
                                    ->columns(1)
                                    ->schema([
                                        Forms\Components\Select::make('location_id')
                                            ->label(__('Location'))
                                            ->nullable()
                                            ->relationship(
                                                name: 'location',
                                                titleAttribute: 'name',
                                            ),

                                        Forms\Components\Select::make('position_id')
                                            ->label(__('Position'))
                                            ->nullable()
                                            ->relationship(
                                                name: 'position',
                                                titleAttribute: 'name',
                                            ),

                                        Forms\Components\Select::make('contract_type_id')
                                            ->label(__('Contract Type'))
                                            ->nullable()
                                            ->relationship(
                                                name: 'contractType',
                                                titleAttribute: 'name',
                                            ),

                                        Forms\Components\Select::make('educations')
                                            ->label(__('Educations'))
                                            ->nullable()
                                            ->relationship(
                                                name: 'educations',
                                                titleAttribute: 'name',
                                            )
                                            ->multiple(),
                                    ]),

                                Forms\Components\Fieldset::make('additional_information')
                                    ->label(__('Additional Information'))
                                    ->columns(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('salary_min')
                                            ->label(__('Salary Min'))
                                            ->nullable()
                                            ->numeric()
                                            ->prefix('€'),

                                        Forms\Components\TextInput::make('salary_max')
                                            ->label(__('Salary Max'))
                                            ->nullable()
                                            ->numeric()
                                            ->prefix('€'),

                                        Forms\Components\TextInput::make('hours_min')
                                            ->label(__('Hours Min'))
                                            ->nullable()
                                            ->numeric(),

                                        Forms\Components\TextInput::make('hours_max')
                                            ->label(__('Hours Max'))
                                            ->nullable()
                                            ->numeric(),
                                    ]),

                                Forms\Components\KeyValue::make('meta')
                                    ->label(__('External Data'))
                                    ->keyLabel(__('Field'))
                                    ->valueLabel(__('Value'))
                                    ->disabled(),
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
                Tables\Columns\TextColumn::make('name'),
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
            RelationManagers\ApplicantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVacancies::route('/'),
            'create' => Pages\CreateVacancy::route('/create'),
            'edit' => Pages\EditVacancy::route('/{record}/edit'),
        ];
    }
}
