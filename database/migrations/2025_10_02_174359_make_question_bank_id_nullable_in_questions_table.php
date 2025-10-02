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
            // Make question_bank_id nullable since we now have test_section_id
            $table->unsignedBigInteger('question_bank_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            // Revert question_bank_id back to not null
            $table->unsignedBigInteger('question_bank_id')->nullable(false)->change();
        });
    }
};
