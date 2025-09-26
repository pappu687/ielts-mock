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
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key constraint removed - managed at application level
            $table->unsignedBigInteger('exam_type_id'); // Foreign key constraint removed - managed at application level
            $table->string('status');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('time_remaining')->nullable();
            $table->string('current_section')->nullable();
            $table->json('session_data')->nullable();
            $table->decimal('overall_band_score', 3, 1)->nullable();
            $table->json('detailed_scores')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_sessions');
    }
};