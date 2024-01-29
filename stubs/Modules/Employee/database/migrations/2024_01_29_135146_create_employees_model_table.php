<?php

declare(strict_types=1);

use App\Models\Employee;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('employee_model', function (Blueprint $table) {
            $table->foreignIdFor(Employee::class)->constrained()->cascadeOnDelete();
            $table->morphs('model');
            $table->unsignedSmallInteger('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_model');
    }
}
