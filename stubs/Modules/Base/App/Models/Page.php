<?php

namespace App\Models;

use App\Traits\Labelable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Seoable;

class Page extends Model
{
    use HasFactory;
    use Labelable;
    use Seoable;

    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function getUrlAttribute(): string
    {
        return route('page.show', ['page' => $this]);
    }
}
