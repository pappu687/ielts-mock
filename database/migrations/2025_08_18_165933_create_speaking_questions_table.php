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
        Schema::create('speaking_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('part_number');
            $table->text('question_text');
            $table->json('follow_up_questions')->nullable();
            $table->string('topic_category');
            $table->string('difficulty_level');
            $table->integer('time_limit');
            $table->json('assessment_criteria')->nullable();
            $table->json('sample_responses')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speaking_questions');
    }
};