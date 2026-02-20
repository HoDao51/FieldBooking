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
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
            $table->foreign('field_id')->references('id')->on('fields');
            $table->foreign('time_id')->references('id')->on('time_slots');
            $table->foreign('payment_id')->references('id')->on('payment_methods');
            $table->foreign('customer_id')->references('id')->on('customers');
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
