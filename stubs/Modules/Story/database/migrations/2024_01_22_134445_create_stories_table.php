<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StoryCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(StoryCategory::class);
            $table->string('name');
            $table->string('slug');
            $table->boolean('visible')->default(false);
            $table->boolean('highlighted')->default(false);
            $table->text('intro')->nullable();
            $table->json('content')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->date('publish_from')->nullable()->index();
            $table->date('publish_until')->nullable()->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
