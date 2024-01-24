<?php

namespace App\Models;

use App\Traits\Labelable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;
    use Labelable;

    protected $guarded = [];

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
