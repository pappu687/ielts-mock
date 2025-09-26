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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_bank_id');            
            $table->json('content');
            $table->string('difficulty_level');
            $table->integer('estimated_time');
            $table->json('metadata')->nullable();
            $table->string('audio_file')->nullable();
            $table->json('image_files')->nullable();
            $table->json('correct_answers')->nullable();
            $table->text('explanation')->nullable();
            $table->mediumText('question_text')->nullable();
            $table->string('question_type')->nullable();
            $table->text('tips')->nullable();
            $table->json('skill_focus_areas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
