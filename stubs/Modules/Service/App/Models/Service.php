<?php

namespace App\Models;

use App\Traits\Labelable;
use App\Traits\Ogable;
use App\Traits\Seoable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use Labelable;
    use Seoable;
    use Ogable;
    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function scopeVisible(Builder $query): void
    {
        $query->where('visible', true);
    }

    public function getUrlAttribute(): string
    {
        return route('service.show', ['service' => $this]);
    }
}
