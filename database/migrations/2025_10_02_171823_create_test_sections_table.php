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
        Schema::create('test_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_id');
            $table->string('name'); // e.g., "Part 1", "Task 1"
            $table->text('description')->nullable();
            $table->integer('order')->default(1);
            $table->integer('time_limit_minutes')->nullable();
            $table->json('instructions')->nullable(); // Section-specific instructions
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->index(['test_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_sections');
    }
};
