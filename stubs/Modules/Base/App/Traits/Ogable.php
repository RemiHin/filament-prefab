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
}
