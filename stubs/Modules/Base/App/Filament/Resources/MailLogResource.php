<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MailLogResource\Pages;
use App\Filament\Resources\MailLogResource\RelationManagers;
use App\Models\MailLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MailLogResource extends Resource
{
    protected static ?string $model = MailLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 40;

    public static function getNavigationGroup(): string
    {
        return __('Manage');
    }


    public static function shouldRegisterNavigation(): bool
    {
        return config('mail.log_mails', true);
    }

    public static function getLabel(): ?string
    {
        return __('Sent email');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Sent emails');
    }

    public static function getNavigationBadge(): ?string
    {
        return MailLog::query()->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\IconColumn::make('sent')
                    ->label(__('Sent'))
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label(__('Subject'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('from_address')
                    ->label(__('From (email)'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('from_name')
                    ->label(__('From (name)'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('to_address')
                    ->label(__('To (email)'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('to_name')
                    ->label(__('To (name)'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
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
            'index' => Pages\ListMailLogs::route('/'),
            'view' => Pages\ViewMailLog::route('/{record}'),
        ];
    }
}
