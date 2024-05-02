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
        Schema::create('admission_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_name');
            $table->string('month');
            $table->string('year');
            $table->unsignedBigInteger('university_id'); // Use unsignedBigInteger() for foreign keys
            $table->foreign('university_id')->references('id')->on('universities'); 
            $table->timestamps();
        });
        
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_sessions');
    }
};
