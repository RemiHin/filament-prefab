<?php

declare(strict_types=1);


namespace App\Traits;

use App\Models\Label;
use Illuminate\Database\Eloquent\Model;

trait Labelable
{
    public static function bootLabelable(): void
    {
        static::resolveRelationUsing('label', function (Model $model) {
            return $model->morphOne(Label::class, 'labelable');
        });
    }
}
