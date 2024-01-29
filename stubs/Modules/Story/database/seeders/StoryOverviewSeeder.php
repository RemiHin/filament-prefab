<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoryOverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storyOverview = Label::getModel('story-overview');

        if(!$storyOverview) {
            $storyPage = Page::query()
                ->create([
                'name' => 'verhalen',
                'slug' => 'verhalen',
                'visible' => true,
            ]);

            $storyPage->label()->create([
                'label' => 'story-overview'
            ]);
        }
    }
}
