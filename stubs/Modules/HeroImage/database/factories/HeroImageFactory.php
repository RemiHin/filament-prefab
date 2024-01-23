<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\HeroImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeroImageFactory extends Factory
{
    protected $model = HeroImage::class;

    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->gpt('Give me a healthcare related hero image title', $this->faker->words(4, true), trimQuotes: true),
            'content' => $this->faker->gpt('Give me a paragraph about a hero in healthcare', $this->faker->paragraph()),
            'primary_cta_text' => $this->faker->gpt('Give me a healthcare related call to action in 3 words', $this->faker->words(3, true)),
            'primary_cta_link' => $this->faker->url,
            'secondary_cta_text' => $this->faker->gpt('Give me a healthcare related call to action in 3 words', $this->faker->words(3, true)),
            'secondary_cta_link' => $this->faker->url,
//      todo:      'image' => FactoryImage::make()->label($title)->cropperField(1200, 800),
            'image_alt' => $title,
        ];
    }

    public function heroable(Model $model): self
    {
        return $this->state([
            'heroable_type' => $model->getMorphClass(),
            'heroable_id' => $model->id,
        ]);
    }
}
