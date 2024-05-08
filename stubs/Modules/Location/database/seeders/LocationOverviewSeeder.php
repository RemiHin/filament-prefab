<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Page;
use Illuminate\Database\Seeder;

class LocationOverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locationOverview = Label::getModel('location-overview');

        if(!$locationOverview) {
            $locationPage = Page::query()
                ->create([
                'name' => 'Locaties',
                'slug' => 'locaties',
                'visible' => true,
            ]);

            $locationPage->label()->create([
                'label' => 'location-overview',
            ]);
        }
    }
}
