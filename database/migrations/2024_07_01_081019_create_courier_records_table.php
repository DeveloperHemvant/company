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
        Schema::create('courier_records', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['inward', 'outward']); // INWARD or OUTWARD
            $table->enum('form_type', ['associate', 'university', 'direct'])->nullable(); // ASSOCIATE, UNIVERSITY, DIRECT
            $table->unsignedBigInteger('associate_id')->nullable(); // ID of associate (if form_type is associate)
            $table->unsignedBigInteger('university_id')->nullable(); // ID of university (if form_type is university)
            $table->string('direct_data')->nullable(); // Direct data (if form_type is direct)
            $table->text('particular_details');
            $table->string('courier_type');
            $table->string('tracking_no');
            $table->enum('delivery_status', ['Delivered', 'Undelivered']);
            $table->text('remarks')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('associate_id')->references('id')->on('associates')->onDelete('set null');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courier_records');
    }
};
