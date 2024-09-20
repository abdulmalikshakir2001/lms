<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// id,trainer(user_id-->extract from user info ) ,programm_id(foreign key),session_for_id(foreign key),region_id(extract from user info),name,description,start_date , end_date,createdAt,updatedAt

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainer');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('session_for_id');
            $table->unsignedBigInteger('region_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
