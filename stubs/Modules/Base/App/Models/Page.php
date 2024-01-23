<?php

namespace App\Models;

use App\Traits\Labelable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use Labelable;
    protected $guarded = [];
}
