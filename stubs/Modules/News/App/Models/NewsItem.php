<?php

namespace App\Models;

use App\Traits\Labelable;
use App\Traits\Ogable;
use App\Traits\Searchable;
use App\Traits\Seoable;
use Awcodes\Curator\Models\Media;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsItem extends Model
{
    use HasFactory;
    use Labelable;
    use Seoable;
    use Ogable;
    use Searchable;

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
        return route('news.show', ['newsItem' => $this]);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id');
    }
}
