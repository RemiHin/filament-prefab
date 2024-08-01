<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Employee;
use Database\Factories\Helpers\FactoryImage;
use Database\Factories\Helpers\WithBlocks;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    use WithBlocks;

    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'name' => $name = fake()->name,
            'function' => fake()->jobTitle,
            'image_id' => FactoryImage::make()->label($name)->cropperField(800, 800),
            'visible' => fake()->boolean,
            'intro' => fake()->text,
        ];
    }
}
