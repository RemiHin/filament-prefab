<?php

declare(strict_types=1);


namespace App\Traits;

use App\Models\Opengraph;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms;
use Awcodes\Curator\Components\Forms\CuratorPicker;

trait Ogable
{
    public static function bootOgable(): void
    {
        static::resolveRelationUsing('og', function (Model $model) {
            return $model->morphOne(Opengraph::class, 'ogable');
        });
    }

    // In order to implement these fields add `static::$model::ogableFields(),` to your fields like any other field
    public static function ogableFields(): Forms\Components\Fieldset
    {
        return
            Forms\Components\Fieldset::make('og')
                ->relationship(
                    name: 'og',
                )
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label(__('Title'))
                        ->string()
                        ->maxLength(250)
                        ->nullable()
                        ->helperText(__('This title will be used when sharing on social media platforms')),

                    CuratorPicker::make('image')
                        ->label(__('Image'))
                        ->nullable()
                        ->helperText(__('This image will be used when sharing on social media platforms. An image with the dimensions of :width by :height is recommended for the best results.', ['width' => 1200, 'height' => 630])),
                ])
                ->columns(1);
    }
}
