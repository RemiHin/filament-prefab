<?php

namespace App\Http\Requests;

use App\Filament\Plugins\BlockModule;
use App\Filament\Plugins\FormBlock;
use Illuminate\Foundation\Http\FormRequest;

class FormBuilderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $form = $this->route('form');

        $rules = [];

        foreach ($form->content as $blockContent) {
            $block = BlockModule::reconstructBlock($blockContent['type'], $blockContent['data']);

            $blockRules = [
                $block->id => [
                    'array',
                ],
            ];

            foreach ($block->getRules() as $field => $fieldRules) {
                $blockRules[$block->id . '.' . $field] = $fieldRules;
            }

            $rules = array_merge($rules, $blockRules);
        }

        return $rules;
    }

    public function attributes()
    {
        $form = $this->route('form');

        $attributes = [];

        foreach ($form->content as $blockContent) {
            /** @var FormBlock $block */
            $block = BlockModule::reconstructBlock($blockContent['type'], $blockContent['data']);

            $attributes = array_merge($attributes, $block->attributes());
        }

        return $attributes;
    }
}
