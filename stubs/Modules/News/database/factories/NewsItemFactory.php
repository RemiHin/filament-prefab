<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\NewsItem;
use Database\Factories\Helpers\FactoryImage;
use Database\Factories\Helpers\WithBlocks;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsItemFactory extends Factory
{
    use WithBlocks;

    protected $model = NewsItem::class;

    public function definition(): array
    {
        return [
            'name' => $name = fake()->words(4, true),
            'slug' => Str::slug($name),
            'visible' => fake()->boolean,
            'intro' => fake()->text,
            'image_id' => FactoryImage::make()->label($name)->cropperField(800, 800),
            'publish_from' => now(),
        ];
    }
}
