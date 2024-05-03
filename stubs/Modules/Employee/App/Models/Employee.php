<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Labelable;
use App\Traits\HasVisibility;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use Labelable;
    use HasVisibility;

    public string $fallbackImage = 'images/employee-fallback.jpg';

    protected $casts = [
        'visible' => 'bool',
    ];

    protected $guarded = [];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id');
    }
}
