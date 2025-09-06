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
        Schema::create('speaking_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_section_id')->constrained()->onDelete('cascade');
            $table->string('audio_file_path');
            $table->text('transcript')->nullable();
            $table->decimal('fluency_coherence_score', 3, 1)->nullable();
            $table->decimal('lexical_resource_score', 3, 1)->nullable();
            $table->decimal('grammar_range_score', 3, 1)->nullable();
            $table->decimal('pronunciation_score', 3, 1)->nullable();
            $table->decimal('overall_band_score', 3, 1)->nullable();
            $table->json('detailed_feedback')->nullable();
            $table->string('assessor_type');
            $table->timestamp('assessed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speaking_assessments');
    }
};