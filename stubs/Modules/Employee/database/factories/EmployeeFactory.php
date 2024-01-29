<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->name,
            'function' => $this->faker->unique()->gpt('Give me a healthcare related job title name', $this->faker->words(2, true), trimQuotes: true),
//        todo: fix it    'image' => FactoryImage::make()->label($name)->cropperField(800, 800),
            'visible' => $this->faker->boolean,
            'intro' => $this->faker->text,
        ];
    }
}
