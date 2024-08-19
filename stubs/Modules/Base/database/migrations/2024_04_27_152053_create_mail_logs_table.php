<?php

use App\Models\MailLog;
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
        Schema::create('mail_logs', function (Blueprint $table) {
            $table->id();

            $table->boolean('sent')->default(false);

            $table->string('subject')->nullable();
            $table->string('from_name')->nullable();
            $table->string('from_address')->nullable();
            $table->string('to_name')->nullable();
            $table->string('to_address')->nullable();
            $table->foreignIdFor(MailLog::class, 'original_id')->nullable()->constrained('mail_logs')->cascadeOnDelete();
            $table->string('message_id')->nullable();
            $table->mediumText('message')->nullable();
            $table->mediumText('raw')
                ->charset('binary')
                ->collation('binary')
                ->nullable();
            $table->boolean('purged')->default(false);
            $table->json('data')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_logs');
    }
};
