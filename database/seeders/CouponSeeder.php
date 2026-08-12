<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code'             => 'WELCOME10',
                'type'             => 'percentage',
                'value'            => 10,
                'min_order_amount' => 0,
                'max_uses'         => null,
                'used_count'       => 0,
                'is_active'        => true,
                'expires_at'       => null,
            ],
            [
                'code'             => 'SAVE200',
                'type'             => 'fixed',
                'value'            => 200,
                'min_order_amount' => 1500,
                'max_uses'         => null,
                'used_count'       => 0,
                'is_active'        => true,
                'expires_at'       => null,
            ],
            [
                'code'             => 'BABY15',
                'type'             => 'percentage',
                'value'            => 15,
                'min_order_amount' => 2000,
                'max_uses'         => 100,
                'used_count'       => 0,
                'is_active'        => true,
                'expires_at'       => now()->addMonths(3),
            ],
            [
                'code'             => 'FLAT500',
                'type'             => 'fixed',
                'value'            => 500,
                'min_order_amount' => 3000,
                'max_uses'         => 50,
                'used_count'       => 0,
                'is_active'        => true,
                'expires_at'       => now()->addMonths(2),
            ],
            [
                'code'             => 'NEWBORN20',
                'type'             => 'percentage',
                'value'            => 20,
                'min_order_amount' => 1000,
                'max_uses'         => 200,
                'used_count'       => 0,
                'is_active'        => true,
                'expires_at'       => now()->addYear(),
            ],
        ];

        foreach ($coupons as $coupon) {
            \App\Models\Coupon::updateOrCreate(['code' => $coupon['code']], $coupon);
        }
    }
}
