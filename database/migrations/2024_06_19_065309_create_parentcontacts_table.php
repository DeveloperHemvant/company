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
        Schema::create('parentcontacts', function (Blueprint $table) {
           
                $table->id();
                $table->string('parent_full_name');
                $table->string('parent_email');
                $table->string('parent_mobile');
                $table->string('student_name');
                $table->boolean('has_laptop_desktop')->default(false);
                $table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parentcontacts');
    }
};
