<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PositionGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PositionGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $name = fake()->words(2, true),
            'slug' => Str::slug($name),
        ];
    }
}
