<?php

declare(strict_types=1);

namespace Database\Seeders\Testing;

use App\Models\NewsItem;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        NewsItem::factory()
            ->withBlocks(5)
            ->count(30 - NewsItem::query()->count())
            ->create();
    }
}
