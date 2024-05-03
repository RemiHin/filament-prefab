<?php

namespace App\Models;

use App\Traits\HasVisibility;
use App\Traits\Publishable;
use Carbon\Carbon;
use App\Traits\Seoable;
use App\Traits\Labelable;
use App\Traits\Searchable;
use App\Contacts\IsSearchable;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model implements IsSearchable
{
    use HasFactory;
    use Labelable;
    use Seoable;
    use Searchable;
    use HasVisibility;
    use Publishable;

    protected $guarded = [];

    protected $casts = [
        'publish_from' => 'date',
        'publish_until' => 'date',
        'visible' => 'bool',
        'content' => 'array',
    ];

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

    public function getName(): string
    {
        return $this->name;
    }

    public function getRoute(): string
    {
        return route('story.show', ['story' => $this]);
    }

    public static function getResourceName(): string
    {
        return __('Story');
    }
}
