<?php

declare(strict_types=1);

namespace App\Filament\Plugins\Blocks;

use App\Filament\Plugins\BaseBlock;
use App\Models\Form;
use Filament\Forms;

class FormBlock extends BaseBlock
{
    public static function getType(): string
    {
        return 'form';
    }

    public static function getLabel(): string
    {
        return __('Form');
    }

    public static function getFields(): array
    {
        return [
            Forms\Components\Select::make('form')
                ->label(__('Form'))
                ->required()
                ->options(Form::query()->pluck('name','id')),
        ];
    }

    public static function factory(): ?array
    {
        return null;
    }

    public function getForm(): ?Form
    {
        return Form::query()->firstWhere('id', $this->form);
    }
}
