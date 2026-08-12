<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        $sampleReviews = [
            [
                'rating'         => 5,
                'reviewer_name'  => 'Amna Imran',
                'reviewer_email' => 'amna@example.com',
                'review_title'   => 'Super Soft Fleece!',
                'review_text'    => 'I bought this for my 2-year-old. The fabric is extremely premium cotton fleece and it did not shrink at all after washing. Will buy more.',
                'is_verified'    => true,
            ],
            [
                'rating'         => 5,
                'reviewer_name'  => 'Bilal Ahmed',
                'reviewer_email' => 'bilal@example.com',
                'review_title'   => 'Perfect fit and cozy',
                'review_text'    => 'Very comfortable design. The stitching is solid and the colors are vibrant, exactly as shown in the photos.',
                'is_verified'    => true,
            ],
            [
                'rating'         => 4,
                'reviewer_name'  => 'Zainab Fatima',
                'reviewer_email' => 'zainab@example.com',
                'review_title'   => 'Great quality sweatshirt',
                'review_text'    => 'The fabric is thick and warm, perfect for the coming winter. Delivery took 3 days to Lahore. Highly satisfied.',
                'is_verified'    => false,
            ],
        ];

        foreach ($products as $product) {
            // Seed 1 to 3 reviews per product randomly
            $count = rand(1, 3);
            $shuffled = $sampleReviews;
            shuffle($shuffled);

            for ($i = 0; $i < $count; $i++) {
                $reviewData = $shuffled[$i];
                $reviewData['product_id'] = $product->id;
                Review::create($reviewData);
            }
        }
    }
}
