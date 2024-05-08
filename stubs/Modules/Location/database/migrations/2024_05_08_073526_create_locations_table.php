<?php

use Awcodes\Curator\Models\Media;
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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Media::class, 'image_id')->nullable()->constrained('media')->nullOnDelete();

            $table->string('name');
            $table->string('slug');
            $table->text('intro')->nullable();
            $table->boolean('visible')->default(true);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('street');
            $table->string('house_number');
            $table->string('postal_code');
            $table->string('city');

            $table->json('content');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
