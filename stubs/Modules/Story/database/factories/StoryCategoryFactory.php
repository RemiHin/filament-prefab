<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\StoryCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoryCategoryFactory extends Factory
{
    protected $model = StoryCategory::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
        ];
    }
}
