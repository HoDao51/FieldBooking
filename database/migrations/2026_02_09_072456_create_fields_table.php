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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->notnullable();
            $table->string('address', 255)->notnullable();
            $table->integer('status')->default('0');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('field_types');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
