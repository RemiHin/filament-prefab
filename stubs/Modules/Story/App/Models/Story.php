<?php

namespace App\Models;

use App\Traits\Labelable;
use App\Traits\Ogable;
use App\Traits\Seoable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    use Labelable;
    use Seoable;
    use Ogable;
    protected $guarded = [];

    protected $casts = [
        'publish_from' => 'date',
        'publish_until' => 'date',
        'content' => 'array',
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

    public function getUrlAttribute(): string
    {
        return route('story.show', ['story' => $this]);
    }
}
