<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Position;
use App\Models\PositionGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Position::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'position_group_id' => PositionGroup::query()->inRandomOrder()->first()->getKey(),
            'name' => fake()->jobTitle(),
        ];
    }
}
