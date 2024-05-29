<?php

use App\Models\ContractType;
use App\Models\Location;
use App\Models\Position;
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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();

            $table->string('external_id')->nullable()->default(null);
            $table->string('external_source')->nullable()->default(null);

            $table->foreignIdFor(Position::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Location::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(ContractType::class)->nullable()->constrained()->nullOnDelete();

            $table->string('name');
            $table->string('slug');

            $table->text('intro')->nullable();

            $table->unsignedSmallInteger('salary_min')->nullable()->default(null);
            $table->unsignedSmallInteger('salary_max')->nullable()->default(null);

            $table->integer('hours_min')->nullable();
            $table->integer('hours_max')->nullable();

            $table->boolean('visible')->default(false);

            $table->timestamp('publish_from')->nullable();
            $table->timestamp('publish_until')->nullable();

            $table->json('content')->nullable();
            $table->json('meta')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
