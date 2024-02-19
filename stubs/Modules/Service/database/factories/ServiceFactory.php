<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->gpt('Give me a name of a service related to healthcare', $this->faker->name, trimQuotes: true),
            'slug' => Str::slug($name),
            'subtitle' => $this->faker->gpt('Give me a subtitle for a service related to healthcare', $this->faker->word, trimQuotes: true),
            'intro' => $this->faker->gpt('Give me an intro paragraph for a service related to healthcare', $this->faker->text),
            'description' => $this->faker->text,
//      TODO: fix image seerder      'image' => FactoryImage::make()->label($name)->cropperField(1200, 800),
            'visible' => $this->faker->boolean,
        ];
    }
}
