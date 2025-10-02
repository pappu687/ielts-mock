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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['listening', 'reading', 'writing', 'speaking']);
            $table->text('description')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('settings')->nullable(); // For storing test-specific settings
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            
            $table->index(['type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
