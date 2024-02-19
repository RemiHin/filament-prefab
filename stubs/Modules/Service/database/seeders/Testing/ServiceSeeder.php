<?php

declare(strict_types=1);

namespace Database\Seeders\Testing;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Service::factory()
            ->count(10 - Service::query()->count())
            ->create();
    }
}
