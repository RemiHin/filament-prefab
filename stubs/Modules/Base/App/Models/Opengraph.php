<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Opengraph extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'open_graphs';

    public function ogable(): MorphTo
    {
        return $this->morphTo();
    }
}
