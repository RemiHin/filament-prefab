<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsOverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsOverview = Label::getModel('news-overview');

        if(!$newsOverview) {
            $newsPage = Page::query()
                ->create([
                'name' => 'nieuws',
                'slug' => 'nieuws',
                'visible' => true,
            ]);

            $newsPage->label()->create([
                'label' => 'news-overview'
            ]);
        }
    }
}
