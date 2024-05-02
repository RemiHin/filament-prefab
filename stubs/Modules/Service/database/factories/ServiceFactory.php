<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Service;
use Database\Factories\Helpers\FactoryImage;
use Database\Factories\Helpers\WithBlocks;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    use WithBlocks;

    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'name' => $name = fake()->unique()->words(4, true),
            'slug' => Str::slug($name),
            'subtitle' => fake()->words(5, true),
            'intro' => fake()->text,
            'description' => fake()->text,
            'image_id' => FactoryImage::make()->label($name)->cropperField(1200, 800),
            'visible' => fake()->boolean,
        ];
    }
}
