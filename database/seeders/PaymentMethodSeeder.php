<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'name' => 'Thanh toán tiền mặt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chuyển khoản ngân hàng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ví điện tử MoMo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'VNPay',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
