<?php

namespace App\Models;

use App\Traits\Seoable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PositionGroup extends Model
{
    use HasFactory;
    use Seoable;

    protected $guarded = [];

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }
}
