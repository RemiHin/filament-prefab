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

class CheckboxesInputBlock extends FormBlock
{
    public static function getType(): string
    {
        return 'input-checkboxes';
    }

    public static function getLabel(): string
    {
        return __('Checkboxes');
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
            'options' => [
                $this->required ? 'required' : 'nullable',
                'array',
                $this->required ? 'min:1' : 'min:0',
            ],
        ];
    }

    public function getAttributes(): array
    {
        return [
            'options' => strtolower($this->title),
        ];
    }

    public function getQuestion(): string
    {
        return $this->title;
    }

    public function getAnswer(array $data): ?string
    {
        $options = Arr::get($data, 'options', []);

        $answers = [];

        foreach ($options as $option) {
            $field = collect($this->options)->firstWhere('id', $option);
            $question = Arr::get($field, 'title');
            $freeInput = Arr::get($data, 'other.' . $option);

            if ($freeInput) {
                $question .= ', ' . $freeInput;
            }

            $answers[] = $question;
        }

        return implode(PHP_EOL, $answers);
    }

    public function getFilamentField(): Field
    {
        return Textarea::make('form_data.' . $this->id . '.answer')
            ->rows(3)
            ->label($this->getQuestion());
    }
}
