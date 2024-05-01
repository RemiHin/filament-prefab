<?php

namespace App\Models;

use App\Traits\Seoable;
use App\Traits\Labelable;
use App\Traits\Searchable;
use App\Contacts\IsSearchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model implements IsSearchable
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getRoute(): string
    {
        return route('page.show', ['page' => $this]);
    }

    public static function getResourceName(): string
    {
        return __('Page');
    }
}
