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
        Schema::table('parents', function (Blueprint $table) {
            $table->string('father_name');
            $table->string('mother_name');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('program_id')->nullable(); // Allow null values
            $table->unsignedBigInteger('session_id')->nullable(); // Allow null values
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parents', function (Blueprint $table) {
            //
        });
    }
};
