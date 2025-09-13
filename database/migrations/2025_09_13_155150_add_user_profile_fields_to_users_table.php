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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->date('date_of_birth')->nullable()->after('last_name');
            $table->string('phone', 20)->nullable()->after('date_of_birth');
            $table->string('street')->nullable()->after('phone');
            $table->string('landmark')->nullable()->after('street');
            $table->string('city')->nullable()->after('landmark');
            $table->string('state')->nullable()->after('city');
            $table->string('postal_code', 20)->nullable()->after('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name', 
                'date_of_birth',
                'phone',
                'street',
                'landmark',
                'city',
                'state',
                'postal_code'
            ]);
        });
    }
};
