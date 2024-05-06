<?php

namespace App\Filament\Resources;

use App\Filament\Plugins\BlockModule;
use App\Filament\Resources\FormBuilderResource\Pages;
use App\Filament\Resources\FormBuilderResource\RelationManagers;
use App\Filament\Resources\FormBuilderResource\RelationManagers\FormResponsesRelationManager;
use App\Models\Form as FormModel;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FormBuilderResource extends Resource
{
    protected static ?string $model = FormModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Tabs::make()
                    ->tabs([
                        Tab::make('form')
                            ->label(__('Form'))
                            ->schema([
                                TextInput::make('name'),

                                BlockModule::make('content', 'form')->live(),
                            ]),

                        Tab::make('notifications')
                            ->label(__('Notifications'))
                            ->schema([
                                Group::make([
                                    Toggle::make('inform_admin')
                                        ->live()
                                        ->default(false),

                                    Grid::make()
                                        ->schema([
                                            TextInput::make('admin_name')
                                                ->visible(fn (Get $get) => $get('inform_admin') === true),

                                            TextInput::make('admin_email')
                                                ->visible(fn (Get $get) => $get('inform_admin') === true),
                                        ]),

                                    Textarea::make('admin_message')
                                        ->rows(5)
                                        ->requiredIf('inform_admin', 1)
                                        ->visible(fn (Get $get) => $get('inform_admin') === true),
                                ]),

                                Group::make([
                                    Toggle::make('inform_respondent')
                                        ->live()
                                        ->default(false),

                                    Grid::make()
                                        ->schema([
                                            Select::make('respondent_name_field')
                                                ->requiredIf('inform_respondent', 1)
                                                ->options(fn (Get $get) => get_form_builder_options($get('content') ?? [], ['input-text']))
                                                ->visible(fn (Get $get) => $get('inform_respondent') === true),

                                            Select::make('respondent_email_field')
                                                ->requiredIf('inform_respondent', 1)
                                                ->options(fn (Get $get) => get_form_builder_options($get('content') ?? [], ['input-email']))
                                                ->visible(fn (Get $get) => $get('inform_respondent') === true),
                                        ]),

                                    Textarea::make('respondent_message')
                                        ->rows(5)
                                        ->requiredIf('inform_respondent', 1)
                                        ->visible(fn (Get $get) => $get('inform_respondent') === true),
                                ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),

                Tables\Columns\TextColumn::make('form_responses_count')->counts('formResponses'),
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
            'index' => Pages\ListFormbuilders::route('/'),
            'create' => Pages\CreateFormbuilder::route('/create'),
            'view' => Pages\ViewFormBuilder::route('{record}'),
            'edit' => Pages\EditFormbuilder::route('/{record}/edit'),
        ];
    }
}
