<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use SolutionForest\FilamentTree\Concern\ModelTree;

class MenuItem extends Model
{
    use HasFactory;
    use ModelTree;

    protected $guarded = [];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function menuable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrl(): ?string
    {
        if ($this->url_type === 'internal') {
            return $this->menuable?->getRoute();
        }

        return $this->url;
    }
}
