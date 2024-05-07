<?php

namespace App\Filament\Plugins\Blocks\Input;

use App\Filament\Plugins\FormBlock;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class TextInputBlock extends FormBlock
{
    public static function getType(): string
    {
        return 'input-text';
    }

    public static function getLabel(): string
    {
        return __('Text');
    }

    public static function getFields(): array
    {
        return [
            TextInput::make('title')
                ->label(__('Title'))
                ->required(),

            Toggle::make('required')
                ->label(__('Required'))
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
            'text' => [
                $this->required ? 'required' : 'nullable',
            ],
        ];
    }

    public function getAttributes(): array
    {
        return [
            'text' => strtolower($this->title),
        ];
    }

    public function getQuestion(): string
    {
        return $this->title;
    }

    public function getAnswer(array $data): ?string
    {
        return $data['text'];
    }
}
