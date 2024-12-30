<?php

namespace RemiHin\FilamentPrefabStubs\Modules\Socials\database\seeders;

use App\Models\Social;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials = [
            [
                'name' => 'LinkedIn',
                'url' => 'https://www.linkedin.com/',
                'icon_name' => 'social-linkedin',
            ],
            [
                'name' => 'X',
                'url' => 'https://www.x.com/',
                'icon_name' => 'social-twitter',
            ],
            [
                'name' => 'Facebook',
                'url' => 'https://www.facebook.com/',
                'icon_name' => 'social-facebook',
            ],
        ];

        foreach($socials as $social)
        {
            Social::updateOrCreate([
                'name' => $social['name']
            ], [
                'url' => $social['url'],
                'icon_name' => $social['icon_name'],
            ]);
        }
    }
}
