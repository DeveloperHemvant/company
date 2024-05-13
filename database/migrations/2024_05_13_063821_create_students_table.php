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
            $table->unsignedBigInteger('university');
            $table->foreign('university')->references('id')->on('universities')->cascadeOnDelete();
            $table->unsignedBigInteger('associate');
            $table->foreign('associate')->references('id')->on('associates')->cascadeOnDelete();
            $table->string('source', 255);
            $table->integer('sr_no');
            $table->string('uni_reg_no', 255);
            $table->string('password', 255);
            $table->string('name', 255);
            $table->string('father_name', 255);
            $table->string('mother_name', 255);
            $table->date('dob');
            $table->string('aadhar_no', 255);
            $table->string('email_id', 255);
            $table->string('address', 255);
            $table->string('mob_no', 255);
            $table->unsignedBigInteger('course');
            $table->foreign('course')->references('id')->on('cousres')->cascadeOnDelete();
            $table->string('spl', 255);
            $table->string('type', 255);
            $table->string('sem_year', 255);
            $table->unsignedBigInteger('session');
            $table->foreign('session')->references('id')->on('admission_sessions')->cascadeOnDelete();
            $table->string('previous_migration', 255);
            $table->string('fee', 255);
            $table->string('exam_status', 255);
            $table->string('project_status', 255);
            $table->date('uni_visit_date');
            $table->string('pass_back', 255);
            $table->string('marksheet_1st_sem', 255);
            $table->string('marksheet_2nd_sem', 255);
            $table->string('marksheet_3rd_sem', 255);
            $table->string('marksheet_4th_sem', 255);
            $table->string('marksheet_5th_sem', 255);
            $table->string('marksheet_6th_sem', 255);
            $table->string('marksheet_7th_sem', 255);
            $table->string('marksheet_8th_sem', 255);
            $table->string('provisional_diploma_degree', 255);
            $table->string('additional_docs', 255);
            $table->string('additional_remarks', 255);
            $table->string('nc', 255);
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
