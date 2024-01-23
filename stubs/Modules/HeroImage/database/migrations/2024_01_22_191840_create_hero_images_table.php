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
        Schema::create('hero_images', function (Blueprint $table) {
            $table->id();
            $table->morphs('heroable');
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('primary_cta_text')->nullable();
            $table->string('primary_cta_link')->nullable();
            $table->string('secondary_cta_text')->nullable();
            $table->string('secondary_cta_link')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_images');
    }
};
