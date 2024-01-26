<?php

declare(strict_types=1);


namespace App\Traits;

use App\Models\Seo;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms;

trait Seoable
{
    public static function bootSeoable(): void
    {
        static::resolveRelationUsing('seo', function (Model $model) {
            return $model->morphOne(Seo::class, 'seoable');
        });
    }

    // In order to implement these fields add `static::$model::seoableFields(),` to your fields like any other field
    public static function seoableFields(): Forms\Components\Fieldset
    {
        return
            Forms\Components\Fieldset::make('seo')
                ->relationship(
                    name: 'seo',
                )
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label(__('SEO title'))
                        ->string()
                        ->maxLength(250)
                        ->nullable()
                        ->helperText(__('The recommended length is between :min and :max characters', [
                            'min' => 50,
                            'max' => 60,
                        ])),

                    Forms\Components\Textarea::make('description')
                        ->label(__('SEO description'))
                        ->string()
                        ->maxLength(250)
                        ->nullable()
                        ->helperText(__('The recommended length is between :min and :max characters', [
                            'min' => 120,
                            'max' => 170,
                        ])),

                    Forms\Components\Toggle::make('noindex')
                        ->label(__('Allow index'))
                        ->default(true),

                    Forms\Components\Toggle::make('nofollow')
                        ->label(__('Allow follow'))
                        ->default(false)
                        ->helperText(__('Allow search engines to follow links on this resource')),
                ])
                ->columns(1);
    }
}
