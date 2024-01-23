<?php

declare(strict_types=1);

namespace Database\Seeders\Testing;

use App\Models\Blog;
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
        Blog::factory()
            ->count(30 - Blog::query()->count())
            ->create();
    }
}
