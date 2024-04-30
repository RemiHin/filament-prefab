<?php

namespace App\Models;

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

class Service extends Model implements IsSearchable
{
    use HasFactory;
    use Labelable;
    use Seoable;
    use Searchable;

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
        return route('service.show', ['service' => $this]);
    }

    public static function getResourceName(): string
    {
        return __('Service');
    }
}
