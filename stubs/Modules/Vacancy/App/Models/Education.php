<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Education extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'educations';

    public function vacancies(): BelongsToMany
    {
        return $this->belongsToMany(Vacancy::class);
    }
}
