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
        Schema::create('test_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_section_id');
            $table->enum('type', ['audio', 'passage', 'image', 'prompt', 'transcript']);
            $table->string('title')->nullable();
            $table->text('content')->nullable(); // For text content like passages or prompts
            $table->string('file_path')->nullable(); // For uploaded files
            $table->string('file_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->json('metadata')->nullable(); // Additional metadata like audio duration, image dimensions
            $table->integer('order')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('test_section_id')->references('id')->on('test_sections')->onDelete('cascade');
            $table->index(['test_section_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_resources');
    }
};
