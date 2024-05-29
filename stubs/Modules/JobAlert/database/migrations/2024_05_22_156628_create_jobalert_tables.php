<?php

declare(strict_types=1);

use App\Models\Vacancy;
use App\Models\JobAlert;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobalertTables extends Migration
{
    public function up(): void
    {
        Schema::create('job_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->unsignedTinyInteger('hours_min');
            $table->unsignedTinyInteger('hours_max');
            $table->dateTime('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('job_alert_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JobAlert::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Vacancy::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('job_alert_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_alert_id')->constrained()->cascadeOnDelete();
            $table->morphs('setting');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_alerts');
        Schema::dropIfExists('job_alert_logs');
        Schema::dropIfExists('job_alert_vacancies');
        Schema::dropIfExists('job_alert_filters');
    }
}
