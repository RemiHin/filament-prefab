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
}
