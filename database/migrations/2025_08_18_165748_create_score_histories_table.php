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
        Schema::create('score_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_session_id')->nullable()->constrained()->onDelete('set null');
            $table->string('skill_type');
            $table->decimal('band_score', 3, 1);
            $table->json('sub_scores')->nullable();
            $table->integer('percentile_rank')->nullable();
            $table->decimal('improvement_rate', 5, 2)->nullable();
            $table->json('weak_areas')->nullable();
            $table->json('strong_areas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_history');
    }
};