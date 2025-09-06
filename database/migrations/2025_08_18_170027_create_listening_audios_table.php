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
        Schema::create('listening_audios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('audio_file_path');
            $table->text('transcript')->nullable();
            $table->integer('duration_seconds');
            $table->string('difficulty_level');
            $table->string('accent_type');
            $table->integer('number_of_speakers');
            $table->string('context_type');
            $table->integer('question_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listening_audios');
    }
};