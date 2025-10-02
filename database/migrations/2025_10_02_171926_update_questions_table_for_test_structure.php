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
        Schema::table('questions', function (Blueprint $table) {
            // Add new columns for test structure
            $table->unsignedBigInteger('test_section_id')->nullable()->after('question_bank_id');
            $table->enum('question_type_new', [
                'mcq', 'fill_blank', 'matching', 'essay', 'speaking_topic',
                'true_false', 'summary_completion', 'multiple_choice',
                'map_labeling', 'note_completion', 'table_completion',
                'flow_chart', 'diagram_labeling', 'sentence_completion'
            ])->nullable()->after('question_type');
            
            // Add columns for better question management
            $table->integer('order')->default(1)->after('question_type_new');
            $table->integer('points')->default(1)->after('order');
            $table->json('options')->nullable()->after('correct_answers'); // For MCQ options
            $table->text('hint')->nullable()->after('tips');
            $table->json('audio_segments')->nullable()->after('audio_file'); // For listening timestamps
            
            // Add foreign key constraint
            $table->foreign('test_section_id')->references('id')->on('test_sections')->onDelete('cascade');
            
            // Add indexes
            $table->index(['test_section_id', 'order']);
            $table->index('question_type_new');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['test_section_id']);
            $table->dropIndex(['test_section_id', 'order']);
            $table->dropIndex(['question_type_new']);
            
            $table->dropColumn([
                'test_section_id',
                'question_type_new',
                'order',
                'points',
                'options',
                'hint',
                'audio_segments'
            ]);
        });
    }
};
