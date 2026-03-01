<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = DB::table('users')->insertGetId([
            'name'       => 'Nghiêm Trường Dương',
            'email'      => 'duong@gmail.com',
            'password'   => Hash::make('123456'),
            'role' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('customers')->insert([
            'name'        => 'Nghiêm Trường Dương',
            'phoneNumber'  => '0909921836',
            'email'        => 'vu@gmail.com',
            'status' => 0,
            'avatar' => null,
            'user_id'      => $user1,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }
}
