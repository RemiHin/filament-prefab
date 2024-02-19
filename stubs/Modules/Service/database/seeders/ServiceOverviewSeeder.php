<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceOverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceOverview = Label::getModel('service-overview');

        if(!$serviceOverview) {
            $servicePage = Page::query()
                ->create([
                'name' => 'diensten',
                'slug' => 'diensten',
                'visible' => true,
            ]);

            $servicePage->label()->create([
                'label' => 'service-overview'
            ]);
        }
    }
}
