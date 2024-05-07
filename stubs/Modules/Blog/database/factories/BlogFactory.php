<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->gpt('Write a title for a healthcare related blog', $this->faker->sentence(4), trimQuotes: true),
            'slug' => 'blog/' . Str::slug($name),
            'visible' => $this->faker->boolean,
            'intro' => $this->faker->gpt('Write the introduction paragraph for a healthcare related blog post', $this->faker->text),
            'publish_from' => now(),
        ];
    }
}
