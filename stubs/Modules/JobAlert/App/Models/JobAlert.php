<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobAlert extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $guarded = ['id'];

    public function filters(): HasMany
    {
        return $this->hasMany(JobAlertFilter::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(JobAlertLog::class);
    }

    public function positions(): Collection
    {
        return $this->filters()
            ->with('setting')
            ->where('job_alert_filters.setting_type', (new Position)->getMorphClass())
            ->groupBy('job_alert_filters.id')
            ->get()
            ->pluck('setting');
    }

    public function educations(): Collection
    {
        return $this->filters()
            ->with('setting')
            ->where('job_alert_filters.setting_type', (new Education)->getMorphClass())
            ->get()
            ->pluck('setting');
    }

    public function locations(): Collection
    {
        return $this->filters()
            ->with('setting')
            ->where('job_alert_filters.setting_type', (new Location)->getMorphClass())
            ->get()
            ->pluck('setting');
    }

    public function contractTypes(): Collection
    {
        return $this->filters()
            ->with('setting')
            ->where('job_alert_filters.setting_type', (new ContractType)->getMorphClass())
            ->get()
            ->pluck('setting');
    }

    public function verify(): void
    {
        $this->update(['email_verified_at' => now()]);
    }

    public function getVerificationUrl(): string
    {
        return URL::signedRoute('job-alert.verify', ['jobAlert' => $this]);
    }

    public function getPreferencesUrl(): string
    {
        return URL::signedRoute('job-alert.preferences', ['jobAlert' => $this]);
    }

    public function getUnsubscribeUrl(): string
    {
        return URL::signedRoute('job-alert.unsubscribe', ['jobAlert' => $this]);
    }

    public function scopeVerified(Builder $builder): Builder
    {
        return $builder->whereNotNull('email_verified_at');
    }

    /**
     * @param array $currentArray
     * @param array $newArray
     * @param string $type
     */
    public function updateJobAlertFilters(array $currentArray, array $newArray, string $type): void
    {
        foreach (array_diff($newArray, $currentArray) as $settingId) {
            JobAlertFilter::create([
                'job_alert_id' => $this->id,
                'setting_type' => $type,
                'setting_id' => $settingId,
            ]);
        }

        // Check if we need to remove locations
        foreach (array_diff($currentArray, $newArray) as $settingId) {
            JobAlertFilter::where([
                'job_alert_id' => $this->id,
                'setting_type' => $type,
                'setting_id' => $settingId,
            ])->delete();
        }
    }
}
