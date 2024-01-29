<?php

declare(strict_types=1);

namespace Database\Seeders\Testing;

use App\Models\Story;
use App\Models\StoryCategory;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        StoryCategory::factory()
            ->count(5 - StoryCategory::query()->count())
            ->create();

        Story::factory()
            ->count(30 - Story::query()->count())
            ->create();
    }
}
