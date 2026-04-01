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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('bookingDate')->notnullable();
            $table->integer('totalPrice')->notnullable();
            $table->integer('status')->default('0');
            $table->string('contactName', 100)->notnullable();
            $table->string('contactPhone', 20)->notnullable();
            $table->string('contactEmail', 100)->notnullable();
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('time_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->timestamps();
            $table->foreign('field_id')->references('id')->on('fields');
            $table->foreign('time_id')->references('id')->on('time_slots');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('employee_id')->references('id')->on('employees')->nullOnDelete();
            $table->index(['field_id', 'bookingDate', 'time_id'], 'bookings_field_date_time_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
