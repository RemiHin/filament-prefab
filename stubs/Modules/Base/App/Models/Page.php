<?php

namespace App\Models;

use App\Contracts\Menuable;
use App\Traits\Labelable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Seoable;

class Page extends Model implements Menuable
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

    public static function getMenuOptions(): array
    {
        return self::query()->pluck('name', 'id')->toArray();
    }

    public static function getResourceName(): string
    {
        return __('Page');
    }

    public function getRoute(): string
    {
        return route('page.show', ['page' => $this]);
    }
}
