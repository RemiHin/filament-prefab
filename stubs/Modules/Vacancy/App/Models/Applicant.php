<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function getNameAttribute(): string
    {
        $name = "{$this->first_name} {$this->addition} {$this->last_name}";

        return preg_replace('/\s+/', ' ', $name);
    }
}
