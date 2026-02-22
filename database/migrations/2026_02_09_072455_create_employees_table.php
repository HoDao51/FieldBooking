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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->notnullable();
            $table->string('phoneNumber', 20)->notnullable();
            $table->string('email', 100)->unique()->notnullable();
            $table->integer('role')->notnullable();
            $table->integer('status')->default('0');
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
