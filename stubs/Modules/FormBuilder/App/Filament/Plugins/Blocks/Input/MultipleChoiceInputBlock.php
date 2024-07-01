<?php

namespace App\Filament\Plugins\Blocks\Input;

use App\Filament\Plugins\FormBlock;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class MultipleChoiceInputBlock extends FormBlock
{
    public static function getType(): string
    {
        return 'input-multiple-choice';
    }

    public static function getLabel(): string
    {
        return __('Multiple choice');
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

            Repeater::make('options')
                ->label(__('Options'))
                ->schema([
                    TextInput::make('title')
                        ->label(__('Title'))
                        ->required(),

                    Toggle::make('free_input')
                        ->label(__('Free input'))
                        ->default(false),

                    Hidden::make('id')
                        ->default(fn () => Str::uuid()->toString()),
                ])
        ];
    }

    public static function factory(): ?array
    {
        return null;
    }

    public function getRules(): array
    {
        return [
            'value' => [
                $this->required ? 'required' : 'nullable',
            ],
        ];
    }

    public function getAttributes(): array
    {
        return [
            'value' => strtolower($this->title),
        ];
    }

    public function getQuestion(): string
    {
        return $this->title;
    }

    public function getAnswer(array $data): ?string
    {
        $field = collect($this->options)->firstWhere('id', Arr::get($data, 'value'));

        $answer = Arr::get($field, 'title');

        if (Arr::get($field, 'free_input') && Arr::get($data, 'other')) {
            $answer .= '; ' . Arr::get($data, 'other');
        }

        return $answer;
    }

    public function freeInputFields(): array
    {
        return collect($this->options)
            ->filter(fn (array $option) => $option['free_input'])
            ->map(fn (array $option) => $option['id'])
            ->toArray();
    }

    public function freeInputJsArray(): string
    {
        return '["' . implode('", "', $this->freeInputFields()) . '"]';
    }
}
