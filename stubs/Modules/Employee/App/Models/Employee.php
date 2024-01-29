<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Labelable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use Labelable;

    public string $fallbackImage = 'images/employee-fallback.jpg';

    protected $guarded = [];

    public function scopeVisible(Builder $query): void
    {
        $query->where('visible', true);
    }
}
