<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Vacancy;
use App\Models\Location;
use App\Models\Position;
use App\Models\Education;
use Illuminate\Support\Str;
use App\Models\ContractType;
use Database\Factories\Helpers\WithBlocks;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacancyFactory extends Factory
{
    use WithBlocks;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacancy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'location_id' => Location::query()->inRandomOrder()->first()->getKey(),
            'position_id' => Position::query()->inRandomOrder()->first()->getKey(),
            'contract_type_id' => ContractType::query()->inRandomOrder()->first()->getKey(),
            'name' => $name = fake()->sentence(4),
            'slug' => Str::slug($name),
            'visible' => fake()->boolean(75),
            'hours_min' => $min = fake()->numberBetween(1, 24),
            'hours_max' => fake()->numberBetween($min, 40),
            'salary_min' => fake()->numberBetween(2000, 5000),
            'salary_max' => fake()->numberBetween(2000, 5000),
            'publish_from' => now(),
            'publish_until' => null,
        ];
    }

    public function visible(): self
    {
        return $this->state(['visible' => true]);
    }

    public function hidden(): self
    {
        return $this->state(['visible' => false]);
    }

    public function withEducations(): self
    {
        if (Education::query()->count() < 6) {
            Education::factory()->count(6 - Education::query()->count())->create();
        }

        return $this->afterCreating(function (Vacancy $vacancy) {
            $vacancy->educations()->attach(Education::query()->inRandomOrder()->limit(rand(1, 3))->get());
        });
    }

    public function withMetaData(): self
    {
        return $this->afterCreating(function (Vacancy $vacancy) {
            $meta = [];

            for ($i = 0; $i < rand(5, 20); $i++) {
                $meta['key_' . $this->faker->word()] = fake()->sentence(4);
            }

            $vacancy->update(['meta' => $meta]);
        });
    }
}
