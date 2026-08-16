<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Deal::insert([
            [
                'discount' => '20% OFF',
                'title' => 'Organic Jumpsuits',
                'description' => 'Soft and gentle baby jumpsuits made from pure organic cotton.',
                'image_path' => 'assets/images/deal_jumpsuits.jpg',
            ],
            [
                'discount' => '15% OFF',
                'title' => 'Cozy Autumn Knitwear',
                'description' => 'Comfortable knit cardigans and sweaters for chilly evening outings.',
                'image_path' => 'assets/images/deal_knitwear.jpg',
            ],
            [
                'discount' => '30% OFF',
                'title' => 'Summer Playwear',
                'description' => 'Lightweight and breathable cotton outfits perfect for active toddlers.',
                'image_path' => 'assets/images/deal_playwear.jpg',
            ],
            [
                'discount' => 'Buy 1 Get 1',
                'title' => 'Organic Sleepwear',
                'description' => 'Keep your baby snug and comfortable all night long.',
                'image_path' => 'assets/images/deal_sleepwear.jpg',
            ]
        ]);
    }
}
