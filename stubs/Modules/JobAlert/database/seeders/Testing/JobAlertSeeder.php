<?php

declare(strict_types=1);

namespace Database\Seeders\Testing;

use App\Models\JobAlert;
use Illuminate\Database\Seeder;

class JobAlertSeeder extends Seeder
{
    public function run(): void
    {
        if (JobAlert::query()->count() < 30) {
            JobAlert::factory()->count(30 - JobAlert::query()->count())->create();
        }
    }
}
