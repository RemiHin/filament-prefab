<?php

namespace App\Models;

use App\Traits\HasVisibility;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasVisibility;

    protected $guarded = [];

    public function getName(): string
    {
        return $this->name;
    }
}
