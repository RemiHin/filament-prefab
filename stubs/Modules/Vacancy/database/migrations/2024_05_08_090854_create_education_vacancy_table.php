<?php

use App\Models\Education;
use App\Models\Vacancy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('education_vacancy', function (Blueprint $table) {
            $table->foreignIdFor(Education::class)->constrained('educations')->cascadeOnDelete();
            $table->foreignIdFor(Vacancy::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_vacancy');
    }
};
