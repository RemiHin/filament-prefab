<?php

namespace App\Models;

use App\Traits\Seoable;
use App\Traits\Labelable;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    use Labelable;
    use Seoable;
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
