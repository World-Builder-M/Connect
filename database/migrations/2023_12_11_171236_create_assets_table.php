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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the asset (e.g., Laptop, Vehicle)
            $table->string('type'); // Type of the asset (e.g., Bike, Car)
            $table->string('serial_number')->unique(); // Unique serial number for the asset
            $table->string('status')->default('available'); // Asset status (e.g., available, in use, under maintenance)
            $table->text('description')->nullable(); // Additional description for the asset
            $table->unsignedBigInteger('organisation_id'); // Foreign key for organization
            $table->unsignedBigInteger('department_id'); // Foreign key for department
            $table->unsignedBigInteger('employee_id')->nullable(); // Foreign key for employee (nullable if not assigned)
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};