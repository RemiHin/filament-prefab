<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ContractType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
        ];
    }
}
