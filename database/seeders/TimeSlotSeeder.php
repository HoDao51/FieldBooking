<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('time_slots')->insert([
            [
                'startTime' => '06:00:00',
                'endTime' => '08:00:00',
                'status' => 1,
            ],
            [
                'startTime' => '08:00:00',
                'endTime' => '10:00:00',
                'status' => 1,
            ],
            [
                'startTime' => '10:00:00',
                'endTime' => '12:00:00',
                'status' => 1,
            ],
            [
                'startTime' => '14:00:00',
                'endTime' => '16:00:00',
                'status' => 1,
            ],
            [
                'startTime' => '16:00:00',
                'endTime' => '18:00:00',
                'status' => 1,
            ],
            [
                'startTime' => '18:00:00',
                'endTime' => '19:30:00',
                'status' => 1,
            ],
            [
                'startTime' => '19:30:00',
                'endTime' => '21:00:00',
                'status' => 1,
            ],
            [
                'startTime' => '21:00:00',
                'endTime' => '22:30:00',
                'status' => 1,
            ],
        ]);
    }
}
