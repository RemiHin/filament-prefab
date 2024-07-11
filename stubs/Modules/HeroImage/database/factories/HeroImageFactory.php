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
            'title' => $title = $this->faker->words(4, true),
            'content' => $this->faker->paragraph(),
            'primary_cta_text' => $this->faker->words(3, true),
            'primary_cta_link' => $this->faker->url,
            'secondary_cta_text' => $this->faker->words(3, true),
            'secondary_cta_link' => $this->faker->url,
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
