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
        Schema::create('writing_prompts', function (Blueprint $table) {
            $table->id();
            $table->integer('task_type');
            $table->text('prompt_text');
            $table->string('image_file')->nullable();
            $table->integer('minimum_words');
            $table->integer('time_limit');
            $table->json('assessment_criteria')->nullable();
            $table->json('sample_responses')->nullable();
            $table->string('difficulty_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writing_prompts');
    }
};