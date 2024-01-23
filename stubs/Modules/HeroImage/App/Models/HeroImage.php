<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class HeroImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function heroable(): MorphTo
    {
        return $this->morphTo();
    }
}
