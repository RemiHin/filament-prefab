<?php

namespace App\Models;

use App\Traits\HasVisibility;
use App\Traits\Publishable;
use Carbon\Carbon;
use App\Traits\Seoable;
use App\Traits\Labelable;
use App\Traits\Searchable;
use App\Contracts\IsSearchable;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsItem extends Model implements IsSearchable
{
    use HasFactory;
    use Labelable;
    use Seoable;
    use Searchable;
    use Publishable;
    use HasVisibility;

    protected $guarded = [];

    protected $casts = [
        'publish_from' => 'date',
        'publish_until' => 'date',
        'visible' => 'bool',
        'content' => 'array',
    ];

    public function getUrlAttribute(): string
    {
        return route('news.show', ['newsItem' => $this]);
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
        return route('news.show', ['newsItem' => $this]);
    }

    public static function getResourceName(): string
    {
        return __('News');
    }
}
