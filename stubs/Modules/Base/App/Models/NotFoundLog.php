<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotFoundLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'latest_occurrence' => 'datetime',
        'count' => 'int',
    ];
}
