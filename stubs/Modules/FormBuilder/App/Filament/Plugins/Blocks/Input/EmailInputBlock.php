<?php

namespace App\Filament\Plugins\Blocks\Input;

use App\Filament\Plugins\FormBlock;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class EmailInputBlock extends FormBlock
{
    public static function getType(): string
    {
        return 'input-email';
    }

    public static function getLabel(): string
    {
        return __('Email');
    }

    public static function getFields(): array
    {
        return [
            TextInput::make('title')
                ->label(__('Title'))
                ->required(),

            Toggle::make('required')
                ->default(true),

            TextInput::make('placeholder')
                ->nullable(),
        ];
    }

    public static function factory(): ?array
    {
        return null;
    }

    public function getRules(): array
    {
        return [
            'email' => [
                $this->required ? 'required' : 'nullable',
            ],
        ];
    }

    public function getAttributes(): array
    {
        return [
            'email' => strtolower($this->title),
        ];
    }

    public function getQuestion(): string
    {
        return $this->title;
    }

    public function getAnswer(array $data): ?string
    {
        return $data['email'];
    }
}
