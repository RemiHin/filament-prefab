<?php

namespace App\Models;

use App\Traits\Labelable;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Ogable;
use App\Traits\Seoable;

class Page extends Model
{
    use HasFactory;
    use Labelable;
    use Seoable;
    use Ogable;
    use Searchable;

    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function getUrlAttribute(): string
    {
        return route('page.show', ['page' => $this]);
    }
}
