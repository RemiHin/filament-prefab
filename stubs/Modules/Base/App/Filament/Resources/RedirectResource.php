<?php

namespace App\Filament\Resources;

use App\Enums\RedirectType;
use App\Filament\Resources\RedirectResource\Pages;
use App\Filament\Resources\RedirectResource\RelationManagers;
use App\Models\Redirect;
use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Validator;

class RedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('Redirects');
    }

    public static function getLabel(): ?string
    {
        return __('Redirect');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Redirects');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('request_path')
                    ->helperText(__('This is a relative path after :url. It starts with a \'/\'.', ['url' => config('app.url')]))
                    ->label(__('Request path'))
                    ->startsWith('/')
                    ->required(),

                TextInput::make('target_path')
                    ->helperText(__('This can be a relative like \'from\' or a full path. A full path starts with http(s).'))
                    ->label(__('Target path'))
                    ->startsWith(['/', 'http', 'https'])
                    ->different('request_path')
                    ->rules([
                        fn (Get $get) => function (string $attribute, string $value, Closure $fail) use ($get) {
                            $from = $get('request_path');

                            if (! empty($value) || ! empty($from)) {
                                $query = Redirect::query()
                                    ->where('request_path', $value)
                                    ->where('target_path', $from);

                                if ($query->exists()) {
                                    $fail(__('Redirect with mirrored from and to exists. This would create a redirect loop, please delete the mirrored redirect before creating this record.'));
                                }
                            }
                        }
                    ])
                    ->required(),

                Select::make('redirect_type')
                    ->label('Redirect type')
                    ->options([
                        RedirectType::FORWARD->value => RedirectType::FORWARD->translate(),
                        RedirectType::PERMANENT->value => RedirectType::PERMANENT->translate(),
                        RedirectType::TEMPORARY->value => RedirectType::TEMPORARY->translate(),
                    ])
                    ->required(),

                Textarea::make('description')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('request_path')
                    ->searchable()
                    ->label(__('Request path')),

                Tables\Columns\TextColumn::make('target_path')
                    ->searchable()
                    ->label(__('Target path')),

                Tables\Columns\TextColumn::make('redirect_type')
                    ->formatStateUsing(fn (int $state) => $state)
                    ->label(__('Redirect type')),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRedirects::route('/'),
            'create' => Pages\CreateRedirect::route('/create'),
            'edit' => Pages\EditRedirect::route('/{record}/edit'),
        ];
    }
}
