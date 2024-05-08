<?php

namespace App\Models;

use App\Contacts\IsSearchable;
use App\Traits\HasVisibility;
use App\Traits\Publishable;
use App\Traits\Seoable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Vacancy extends Model implements IsSearchable
{
    use HasFactory;
    use Publishable;
    use HasVisibility;
    use Seoable;
    use SoftDeletes;

    protected $dates = [
        'publish_at',
        'publish_until',
    ];

    protected $guarded = [];

    protected $casts = [
        'visible' => 'bool',
        'salary_min' => 'int',
        'salary_max' => 'int',
        'content' => 'array',
        'meta' => 'array',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function contractType(): BelongsTo
    {
        return $this->belongsTo(ContractType::class);
    }

    public function educations(): BelongsToMany
    {
        return $this->belongsToMany(Education::class);
    }

    public function getSalaryAttribute(): ?string
    {
        $values = array_filter([
            $this->salary_min,
            $this->salary_max,
        ]);

        if (! count($values)) {
            return null;
        }

        if ($this->salary_min === $this->salary_max) {
            return $this->formatSalary((int) $this->salary_max);
        }

        foreach ($values as $i => $value) {
            $values[$i] = $this->formatSalary((int) $value);
        }

        return implode(' &#8211; ', $values);
    }

    public function formatSalary(int $salary): string
    {
        return sprintf('&euro;%s', number_format($salary, 0, ',', '.'));
    }

    public function getHoursAttribute(): ?string
    {
        $values = array_filter([
            $this->hours_min,
            $this->hours_max,
        ]);

        if (! count($values)) {
            return null;
        }

        if ($this->hours_min === $this->hours_max) {
            return (string) $this->hours_max;
        }

        return implode(' &#8211; ', $values);
    }

    public function scopeHoursMin(Builder $builder, ?int $hours): Builder
    {
        if (is_null($hours)) {
            return $builder;
        }

        $raw = DB::raw('
            CASE
                WHEN `vacancies`.`hours_max` IS NOT NULL THEN `vacancies`.`hours_max`
                ELSE `vacancies`.`hours_min`
            END
        ');

        return $builder->where($raw, '>=', $hours);
    }

    public function scopeHoursMax(Builder $builder, ?int $hours): Builder
    {
        if (is_null($hours)) {
            return $builder;
        }

        $raw = DB::raw('
            CASE
                WHEN `vacancies`.`hours_min` IS NOT NULL THEN `vacancies`.`hours_min`
                ELSE `vacancies`.`hours_max`
            END
        ');

        return $builder->where($raw, '<=', $hours);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRoute(): string
    {
        return route('vacancy.show', ['vacancy' => $this]);
    }

    public static function getResourceName(): string
    {
        return __('Vacancy');
    }
}
