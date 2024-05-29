<?php

declare(strict_types=1);

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\JobAlert;
use App\Models\Location;
use App\Models\Position;
use App\Models\Education;
use App\Models\ContractType;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobAlertFactory extends Factory
{
    protected $model = JobAlert::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'email_verified_at' => fake()->dateTime(Carbon::yesterday()),
            'hours_min' => $min = fake()->numberBetween(8, 32),
            'hours_max' => fake()->numberBetween($min, 40),
        ];
    }

    public function hours($min = 0, $max = 40): self
    {
        return $this->state([
            'hours_min' => $min,
            'hours_max' => $max,
        ]);
    }

    public function withVacancies(int $vacancyCount = 1): self
    {
        if (Vacancy::query()->count() < $vacancyCount) {
            Vacancy::factory()->count($vacancyCount - Vacancy::query()->count())->create();
        }

        return $this->afterCreating(function (JobAlert $jobAlert) use ($vacancyCount) {
            $jobAlert->logs()->createMany(
                Vacancy::limit($vacancyCount)->get()->map(fn ($vacancy) => ['vacancy_id' => $vacancy->id])
            );
        });
    }

    public function withPosition(Position $position): self
    {
        return $this->afterCreating(function (JobAlert $jobAlert) use ($position) {
            $jobAlert->filters()->create([
                'setting_type' => (new Position())->getMorphClass(),
                'setting_id' => $position->id,
            ]);
        });
    }

    public function withEducation(Education $education): self
    {
        return $this->afterCreating(function (JobAlert $jobAlert) use ($education) {
            $jobAlert->filters()->create([
                'setting_type' => (new Education())->getMorphClass(),
                'setting_id' => $education->id,
            ]);
        });
    }

    public function withLocation(Location $location): self
    {
        return $this->afterCreating(function (JobAlert $jobAlert) use ($location) {
            $jobAlert->filters()->create([
                'setting_type' => (new Location())->getMorphClass(),
                'setting_id' => $location->id,
            ]);
        });
    }

    public function withContractType(ContractType $contractType): self
    {
        return $this->afterCreating(function (JobAlert $jobAlert) use ($contractType) {
            $jobAlert->filters()->create([
                'setting_type' => (new ContractType())->getMorphClass(),
                'setting_id' => $contractType->id,
            ]);
        });
    }
}
