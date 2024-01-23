<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{

    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->gpt('Give me a very short page title for an article related to healthcare', $this->faker->words(3, true), trimQuotes: true),
            'slug' => Str::slug($name),
            'content' => $this->faker->gpt('Give me a paragraph about an article related to healthcare', $this->faker->paragraph),
            'visible' => true,
        ];
    }
}
