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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_section_id'); // Foreign key constraint removed - managed at application level
            $table->unsignedBigInteger('question_id')->nullable(); // Foreign key constraint removed - managed at application level
            $table->json('user_response')->nullable();
            $table->integer('time_spent')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->decimal('partial_score', 5, 2)->nullable();
            $table->json('ai_feedback')->nullable();
            $table->json('human_feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};