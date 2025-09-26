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
        Schema::create('exam_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_session_id'); // Foreign key constraint removed - managed at application level
            $table->string('section_type');
            $table->string('status');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('time_limit');
            $table->json('responses')->nullable();
            $table->decimal('raw_score', 5, 2)->nullable();
            $table->decimal('band_score', 3, 1)->nullable();
            $table->json('feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_sections');
    }
};