<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Page;
use Illuminate\Database\Seeder;

class JobAlertPageSeeder extends Seeder
{
    protected array $pages = [
        'job-alert-overview' => [
            'name' => 'Vacature alarm',
            'slug' => 'vacature-alarm',
            'visible' => true,
        ],
        'job-alert-confirmed' => [
            'name' => 'Vacature-alarm bevestigd',
            'slug' => 'vacature-alarm-bevestigd',
            'visible' => true,
        ],
        'job-alert-unsubscribe' => [
            'name' => 'Uitgeschreven',
            'slug' => 'vacature-alarm-uitgeschreven',
            'visible' => true,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->pages as $label => $page) {
            $locationOverview = Label::getModel($label);

            if(!$locationOverview) {
                $locationPage = Page::query()
                    ->create($page);

                $locationPage->label()->create([
                    'label' => $label,
                ]);
            }
        }
    }
}
