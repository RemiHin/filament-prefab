<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Seoable;
use App\Traits\Labelable;
use App\Traits\Searchable;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory;
    use Labelable;
    use Seoable;
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
        return route('story.show', ['story' => $this]);
    }

    public function storyCategory(): BelongsTo
    {
        return $this->belongsTo(StoryCategory::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id');
    }
}
