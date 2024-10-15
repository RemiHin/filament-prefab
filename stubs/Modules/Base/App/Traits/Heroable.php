<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\HeroImage;
use Filament\Forms\Get;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Awcodes\Curator\Components\Forms\CuratorPicker;

trait Heroable
{
    public static function bootHeroable(): void
    {
        static::resolveRelationUsing('heroImage', function (Model $model) {
            return $model->morphOne(HeroImage::class, 'heroable');
        });
    }

    // In order to implement these fields add `static::$model::heroableFields(),` to your fields like any other field
    public static function heroableFields(): Forms\Components\Fieldset
    {
        return
            Forms\Components\Fieldset::make('HeroImage')
                ->label(__('Hero image'))
                ->relationship(
                    name: 'heroImage',
                    condition: fn(?array $state): bool => $state['has_hero_image']
                )
                ->schema([
                    Forms\Components\Toggle::make('has_hero_image')
                        ->label(__('Has hero image'))
                        ->live()
                        ->dehydrated(false)
                        ->afterStateHydrated(fn(Forms\Components\Toggle $component) => $component->state($component->getModelInstance()->exists)),

                    Forms\Components\TextInput::make('title')
                        ->label(__('Title'))
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\RichEditor::make('content')
                        ->label(__('Content'))
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\TextInput::make('primary_cta_text')
                        ->label(__('Primary CTA text'))
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\TextInput::make('primary_cta_link')
                        ->label(__('Primary CTA link'))
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\TextInput::make('secondary_cta_text')
                        ->label(__('Secondary CTA text'))
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\TextInput::make('secondary_cta_link')
                        ->label('Secondary CTA link')
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    CuratorPicker::make('image_id')
                        ->buttonLabel(__('Add image'))
                        ->label(__('Image'))
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),
                ])
                ->columns(1);
    }
}
