<?php

namespace App\Models;

use App\Traits\Labelable;
use App\Traits\Seoable;
use Awcodes\Curator\Models\Media;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Story extends Model
{
    use HasFactory;
    use Labelable;
    use Seoable;

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
