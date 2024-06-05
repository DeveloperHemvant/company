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
            //
            $table->string('city')->nullable()->after('address');
            $table->string('pincode')->nullable()->after('city');
            $table->string('state')->nullable()->after('pincode');
            $table->string('landmobile')->nullable()->after('mobile');
            $table->string('smobile')->nullable()->after('landmobile');
            $table->string('pname')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('city');
            $table->dropColumn('pincode');
            $table->dropColumn('state');
            $table->dropColumn('landmobile');
            $table->dropColumn('smobile');
            $table->dropColumn('pname');
        });
    }
};
