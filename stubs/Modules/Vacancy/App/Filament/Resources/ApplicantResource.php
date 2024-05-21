<?php

namespace App\Filament\Resources;

use App\Enums\ApplicantStatus;
use App\Filament\Resources\ApplicantResource\Pages;
use App\Filament\Resources\ApplicantResource\RelationManagers;
use App\Models\Applicant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ApplicantResource extends Resource
{
    protected static ?string $model = Applicant::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 101;

    public static function getNavigationGroup(): string
    {
        return __('Vacancies');
    }

    public static function getLabel(): ?string
    {
        return __('Applicant');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Applicants');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Select::make('vacancy_id')
                    ->label(__('Vacancy'))
                    ->relationship('vacancy', 'name'),

                Forms\Components\Grid::make('name')
                    ->columns(5)
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label(__('First Name'))
                            ->columnSpan(2)
                            ->required(),

                        Forms\Components\TextInput::make('addition')
                            ->label(__('Addition'))
                            ->nullable(),

                        Forms\Components\TextInput::make('last_name')
                            ->label(__('Last Name'))
                            ->columnSpan(2)
                            ->required(),
                    ]),

                Forms\Components\Grid::make('contact')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label(__('Email address'))
                            ->required(),

                        Forms\Components\TextInput::make('phone')
                            ->label(__('Phone'))
                            ->required(),
                    ]),

                Forms\Components\Textarea::make('motivation')
                    ->rows(4)
                    ->required(),

                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        ApplicantStatus::NEW->value => ApplicantStatus::NEW->translate(),
                        ApplicantStatus::REJECTED->value => ApplicantStatus::REJECTED->translate(),
                        ApplicantStatus::PLANNED->value => ApplicantStatus::PLANNED->translate(),
                        ApplicantStatus::HIRED->value => ApplicantStatus::HIRED->translate(),
                    ]),

                Forms\Components\FileUpload::make('cv')
                    ->label(__('CV'))
                    ->disk('cv')
                    ->visibility('private')
                    ->downloadable()
                    ->previewable()
                    ->deletable(false),

                // TODO: Relation manager
                // TODO: Send mail to applicant

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vacancy.name')
                    ->label(__('Vacancy'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),

                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(fn(string $state) => ApplicantStatus::tryFrom($state)->translate())
                    ->label(__('Status')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListApplicants::route('/'),
            'create' => Pages\CreateApplicant::route('/create'),
            'edit' => Pages\EditApplicant::route('/{record}/edit'),
        ];
    }
}
