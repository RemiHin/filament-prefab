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
                ->relationship(
                    name: 'heroImage',
                    condition: fn (?array $state): bool => $state['has_hero_image']
                )
                ->schema([
                    Forms\Components\Toggle::make('has_hero_image')
                        ->live()
                        ->dehydrated(false)
                        ->default(false),

                    Forms\Components\TextInput::make('title')
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\RichEditor::make('content')
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\TextInput::make('primary_cta_text')
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\TextInput::make('primary_cta_link')
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\TextInput::make('secondary_cta_text')
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    Forms\Components\TextInput::make('secondary_cta_link')
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),

                    CuratorPicker::make('image')
                        ->hidden(fn(Forms\Get $get) => !$get('has_hero_image')),
                ])
                ->columns(1);
    }
}
