<?php

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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->json('content');

            $table->boolean('inform_admin');
            $table->string('admin_name')->nullable();
            $table->string('admin_email')->nullable();
            $table->text('admin_message')->nullable();

            $table->boolean('inform_respondent');
            $table->string('respondent_name_field')->nullable();
            $table->string('respondent_email_field')->nullable();
            $table->string('respondent_message')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
