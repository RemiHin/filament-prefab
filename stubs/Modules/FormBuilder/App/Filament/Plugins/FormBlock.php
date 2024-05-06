<?php

namespace App\Filament\Plugins;

use App\Contracts\FormBlock as FormBlockContract;
use App\Filament\Plugins\BaseBlock;

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
}
