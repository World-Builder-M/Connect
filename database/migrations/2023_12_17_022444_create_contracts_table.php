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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('organisation_id'); 
            $table->unsignedBigInteger('employee_id'); 
            $table->date('start_date');
            $table->date('end_date');
            $table->text('terms');
            $table->decimal('monthly_rent', 10, 2);
            $table->decimal('deposit', 10, 2);
            $table->string('status');
            $table->timestamps();

            // Foreign keys
            $table->foreign('asset_id')->references('id')->on('assets');
            $table->foreign('organisation_id')->references('id')->on('organisations'); 
            $table->foreign('employee_id')->references('id')->on('employees'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
