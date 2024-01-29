<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class StoryCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stories(): HasMany
    {
        return $this->hasMany(Story::class);
    }
}
