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
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('skill_type');
            $table->decimal('current_level', 3, 1);
            $table->decimal('target_level', 3, 1);
            $table->integer('tests_completed');
            $table->decimal('average_score', 3, 1);
            $table->decimal('best_score', 3, 1);
            $table->integer('time_spent_practicing');
            $table->timestamp('last_activity')->nullable();
            $table->integer('streak_days');
            $table->json('improvement_areas')->nullable();
            $table->json('achievements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};