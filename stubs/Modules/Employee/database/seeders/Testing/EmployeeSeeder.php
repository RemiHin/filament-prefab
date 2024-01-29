<?php

declare(strict_types=1);

namespace Database\Seeders\Testing;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Employee::query()->count() < 30) {
            Employee::factory()->count(30 - Employee::query()->count())->create();
        }
    }
}
