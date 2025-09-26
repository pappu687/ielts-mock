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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key constraint removed - managed at application level
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('education_level')->nullable();
            $table->string('ielts_experience')->nullable();
            $table->date('test_date_target')->nullable();
            $table->text('study_goals')->nullable();
            $table->integer('preparation_time_per_week')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};