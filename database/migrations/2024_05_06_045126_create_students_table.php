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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UNIVERSITY');
            $table->foreign('UNIVERSITY')->references('id')->on('universities')->cascadeOnDelete();
            $table->unsignedBigInteger('ASSOCIATE');
            $table->foreign('ASSOCIATE')->references('id')->on('associates')->cascadeOnDelete();
            $table->string('SOURCE', 255);
            $table->integer('SR_NO');
            $table->string('UNI_REG_NO', 255);
            $table->string('PASSWORD', 255);
            $table->string('NAME', 255);
            $table->string('FATHER_NAME', 255);
            $table->string('MOTHER_NAME', 255);
            $table->date('DOB');
            $table->string('AADHAR_NO', 255);
            $table->string('EMAIL_ID', 255);
            $table->string('ADDRESS', 255);
            $table->string('MOB_NO', 255);
            $table->unsignedBigInteger('COURSE');
            $table->foreign('COURSE')->references('id')->on('cousres')->cascadeOnDelete();
            $table->string('SPL', 255);
            $table->string('TYPE', 255);
            $table->string('SEM_YEAR', 255);
            $table->unsignedBigInteger('SESSION');
            $table->foreign('SESSION')->references('id')->on('admission_sessions')->cascadeOnDelete();
            $table->string('PREVIOUS_MIGRATION', 255);
            $table->string('FEE', 255);
            $table->string('EXAM_STATUS', 255);
            $table->string('PROJECT_STATUS', 255);
            $table->date('UNI_VISIT_DATE');
            $table->string('PASS_BACK', 255);
            $table->string('MARKSHEET_1ST_SEM', 255);
            $table->string('MARKSHEET_2ND_SEM', 255);
            $table->string('MARKSHEET_3RD_SEM', 255);
            $table->string('MARKSHEET_4TH_SEM', 255);
            $table->string('MARKSHEET_5TH_SEM', 255);
            $table->string('MARKSHEET_6TH_SEM', 255);
            $table->string('MARKSHEET_7TH_SEM', 255);
            $table->string('MARKSHEET_8TH_SEM', 255);
            $table->string('PROVISIONAL_DIPLOMA_DEGREE', 255);
            $table->string('ADDITIONAL_DOCS', 255);
            $table->string('ADDITIONAL_REMARKS', 255);
            $table->string('NC', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
