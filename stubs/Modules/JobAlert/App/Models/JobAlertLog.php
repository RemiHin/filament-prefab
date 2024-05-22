<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobAlertLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacancy_id',
        'job_alert_id',
    ];
}
