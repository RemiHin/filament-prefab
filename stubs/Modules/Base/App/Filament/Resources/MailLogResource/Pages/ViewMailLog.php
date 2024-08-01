<?php

namespace App\Filament\Resources\MailLogResource\Pages;

use App\Filament\Resources\MailLogResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;

class ViewMailLog extends ViewRecord
{
    protected static string $resource = MailLogResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Toggle::make('sent')
                    ->label(__('Sent')),

                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('from_address')
                            ->label(__('From (email)'))
                            ->formatStateUsing(fn() => $this->record->from_address),

                        Forms\Components\TextInput::make('from_name')
                            ->label(__('From (name)'))
                            ->formatStateUsing(fn() => $this->record->from_name),
                    ]),

                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('to_address')
                            ->label(__('To (email)'))
                            ->formatStateUsing(fn() => $this->record->to_address),

                        Forms\Components\TextInput::make('to_name')
                            ->label(__('To (name)'))
                            ->formatStateUsing(fn() => $this->record->to_name),
                    ]),

                Forms\Components\TextInput::make('subject')
                    ->label(__('Subject'))
                    ->formatStateUsing(fn() => $this->record->subject),

                Forms\Components\Textarea::make('body')
                    ->label(__('Message'))
                    ->formatStateUsing(fn() => $this->record->body)
                    ->view('mail.preview'),
            ]);
    }
}
