<?php

namespace App\Models;

use App\Traits\Labelable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    use Labelable;

    protected $guarded = [];

    protected $casts = [
        'publish_from' => 'date',
        'publish_until' => 'date',
    ];

    public function scopePublished(Builder $query): void
    {
        $query->where(function (Builder $query) {
            $query->where('publish_from', '<=', Carbon::now())
                ->orWhereNull('publish_from');
        })->where(function (Builder $query) {
            $query->where('publish_until', '>=', Carbon::now())
                ->orWhereNull('publish_until');
        });
    }

    public function scopeVisible(Builder $query): void
    {
        $query->where('visible', true);
    }
}
