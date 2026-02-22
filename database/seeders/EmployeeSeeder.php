<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = DB::table('users')->insertGetId([
            'name'       => 'Trần Đức Hiếu',
            'email'      => 'hieu@gmail.com',
            'password'   => Hash::make('123456'),
            'role' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('employees')->insert([
            'name'        => 'Trần Đức Hiếu',
            'phoneNumber'  => '0901123123',
            'email'        => 'hieu@gmail.com',
            'role' => 0,
            'user_id'      => $user1,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $user2 = DB::table('users')->insertGetId([
            'name'       => 'Ngô Việt Anh',
            'email'      => 'anh@gmail.com',
            'password'   => Hash::make('123456'),
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('employees')->insert([
            'name'        => 'Ngô Việt Anh',
            'phoneNumber'  => '0901126223',
            'email'        => 'anh@gmail.com',
            'role' => 0,
            'user_id'      => $user2,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $user3 = DB::table('users')->insertGetId([
            'name'       => 'Trần Thái Vũ',
            'email'      => 'vu@gmail.com',
            'password'   => Hash::make('123456'),
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('employees')->insert([
            'name'        => 'Trần Thái Vũ',
            'phoneNumber'  => '0909923123',
            'email'        => 'vu@gmail.com',
            'role' => 0,
            'user_id'      => $user3,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }
}
