<?php

declare(strict_types=1);

use App\Models\StoryCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('story_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('story_categories');
        Schema::table('stories', function (Blueprint $table) {
            $table->dropForeignIdFor(StoryCategory::class);
        });
    }
};
