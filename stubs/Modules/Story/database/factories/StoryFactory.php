<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Story;
use App\Models\StoryCategory;
use Database\Factories\Helpers\FactoryImage;
use Database\Factories\Helpers\WithBlocks;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoryFactory extends Factory
{
    use WithBlocks;

    protected $model = Story::class;

    public function definition(): array
    {
        return [
            'name' => $name = fake()->unique()->words(4, true),
            'story_category_id' => StoryCategory::query()->inRandomOrder()->first()?->id,
            'slug' => Str::slug($name),
            'visible' => fake()->boolean,
            'intro' => fake()->text,
            'image_id' => FactoryImage::make()->label($name)->cropperField(800, 800),
            'publish_from' => now(),
        ];
    }
}
