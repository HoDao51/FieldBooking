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
        Schema::table('bookings', function (Blueprint $table) {
            $table->index('field_id', 'bookings_field_id_index');
            $table->index('time_id', 'bookings_time_id_index');
            $table->dropUnique('unique_field_date_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unique(['field_id', 'bookingDate', 'time_id'], 'unique_field_date_time');
            $table->dropIndex('bookings_field_id_index');
            $table->dropIndex('bookings_time_id_index');
        });
    }
};
