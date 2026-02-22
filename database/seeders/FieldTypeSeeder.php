<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('field_types')->insert([
            [
                'name' => '5 người',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '7 người',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '9 người',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '11 người',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
