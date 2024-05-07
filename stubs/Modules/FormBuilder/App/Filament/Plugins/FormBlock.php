<?php

namespace App\Filament\Plugins;

use App\Contracts\FormBlock as FormBlockContract;
use App\Filament\Plugins\BaseBlock;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;

abstract class FormBlock extends BaseBlock implements FormBlockContract
{
    public function attributes(): array
    {
        $attributes = [];

        foreach ($this->getAttributes() as $attribute => $translation) {
            $attributes[$this->id . '.' . $attribute] = $translation;
        }

        return $attributes;
    }

    public function getFilamentField(): Field
    {
        return TextInput::make('form_data.' . $this->id . '.answer')
            ->label($this->getQuestion());
    }
}
