<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Location;
use Database\Factories\Helpers\FactoryImage;
use Database\Factories\Helpers\WithBlocks;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    use WithBlocks;

    protected $model = Location::class;

    public function definition(): array
    {
        return [
            'name' => $name = fake()->unique()->words(3, true),
            'image_id' => FactoryImage::make()->label($name)->cropperField(800, 800),
            'slug' => Str::slug($name),
            'intro' => fake()->text(),
            'visible' => fake()->boolean(),
            'phone' => fake()->phonenumber(),
            'email' => fake()->email(),
            'street' => fake()->streetName(),
            'house_number' => fake()->numberBetween(1, 100) . (fake()->boolean(30) ? fake()->randomElement(['A', 'B', 'C']) : ''),
            'postal_code' => fake()->postCode(),
            'city' => fake()->city(),
        ];
    }
}
