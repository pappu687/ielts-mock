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
        Schema::create('writing_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_section_id'); // Foreign key constraint removed - managed at application level
            $table->text('response_text');
            $table->integer('word_count');
            $table->decimal('task_achievement_score', 3, 1)->nullable();
            $table->decimal('coherence_cohesion_score', 3, 1)->nullable();
            $table->decimal('lexical_resource_score', 3, 1)->nullable();
            $table->decimal('grammar_accuracy_score', 3, 1)->nullable();
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
        Schema::dropIfExists('writing_assessments');
    }
};