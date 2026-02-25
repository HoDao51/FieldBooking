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
                'name' => 'Sân 5 người',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sân 7 người',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sân 9 người',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sân 11 người',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
