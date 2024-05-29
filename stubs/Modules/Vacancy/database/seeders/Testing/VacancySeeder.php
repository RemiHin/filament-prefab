<?php

declare(strict_types=1);

namespace Database\Seeders\Testing;

use App\Models\Vacancy;
use App\Models\Position;
use App\Models\ContractType;
use App\Models\PositionGroup;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        PositionGroup::factory()
            ->count(5 - PositionGroup::query()->count())
            ->create();

        Position::factory()
            ->count(10 - Position::query()->count())
            ->create();

        ContractType::factory()
            ->count(3 - ContractType::query()->count())
            ->create();

        Vacancy::factory()
            ->count(20 - Vacancy::query()->count())
            ->withMetaData()
            ->withEducations()
            ->withBlocks(5)
            ->create();
    }
}
