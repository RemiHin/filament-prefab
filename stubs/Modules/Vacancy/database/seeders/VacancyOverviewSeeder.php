<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacancyOverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vacancyOverview = Label::getModel('vacancy-overview');

        if(!$vacancyOverview) {
            $vacancyPage = Page::query()
                ->create([
                'name' => 'Vacatures',
                'slug' => 'vacatures',
                'visible' => true,
            ]);

            $vacancyPage->label()->create([
                'label' => 'vacancy-overview'
            ]);
        }
    }
}
