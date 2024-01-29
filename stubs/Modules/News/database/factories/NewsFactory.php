<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\NewsItem;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = NewsItem::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->gpt('Write a title for a healthcare related news article', $this->faker->sentence(4), trimQuotes: true),
            'slug' => 'nieuws/' . Str::slug($name),
            'visible' => $this->faker->boolean,
            'intro' => $this->faker->gpt('Write the introduction paragraph for a healthcare related news item', $this->faker->text),
//  TODO:          'image' => FactoryImage::make()->label($name)->cropperField(1200, 800),
            'image_alt' => $this->faker->name(),
            'publish_from' => now(),
        ];
    }
}
