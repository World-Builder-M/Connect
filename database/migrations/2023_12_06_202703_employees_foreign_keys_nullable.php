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
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->change();
            $table->foreignId('province_id')->nullable()->change();
            $table->foreignId('city_id')->nullable()->change();
            $table->foreignId('department_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('country_id')->constrained()->cascadeOnDelete()->change();
            $table->foreignId('province_id')->constrained()->cascadeOnDelete()->change();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete()->change();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete()->change();
        });
    }
};
