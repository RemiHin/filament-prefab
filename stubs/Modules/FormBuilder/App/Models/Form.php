<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'inform_admin' => 'bool',
        'inform_respondent' => 'bool',
        'content' => 'array',
    ];

    public function formResponses(): HasMany
    {
        return $this->hasMany(FormResponse::class);
    }
}
