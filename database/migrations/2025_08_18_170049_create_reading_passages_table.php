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
        Schema::create('reading_passages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('difficulty_level');
            $table->integer('word_count');
            $table->string('source')->nullable();
            $table->string('topic_category');
            $table->json('question_types')->nullable();
            $table->integer('estimated_reading_time');
            $table->string('academic_or_general');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reading_passages');
    }
};