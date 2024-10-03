<?php

namespace App\Filament\Resources\VacancyResource\RelationManagers;

use App\Enums\ApplicantStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ApplicantsRelationManager extends RelationManager
{
    protected static string $relationship = 'applicants';

    public static function getLabel(): ?string
    {
        return __('Applicant');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Applicants');
    }

    protected function getTableHeading(): string|Htmlable|null
    {
        return __('Applicants');
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
