<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobAlertFilter extends Model
{
    protected $fillable = [
        'job_alert_id',
        'setting_type',
        'setting_id',
    ];

    public function jobAlert(): BelongsTo
    {
        return $this->belongsTo(JobAlert::class);
    }

    public function setting(): MorphTo
    {
        return $this->morphTo('setting');
    }
}
