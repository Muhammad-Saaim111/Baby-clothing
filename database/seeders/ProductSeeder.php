<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Splatter Print Sweatshirt',
                'price' => 1499,
                'old_price' => 1899,
                'description' => 'A trendy and comfortable black sweatshirt featuring a unique white splatter print. Perfect for casual wear and keeping your little one cozy.',
                'image_path' => 'assets/images/products/media__1785749405584_front.jpg',
                'category' => 'Little Girls',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['100% Premium Cotton Fleece', 'Ribbed cuffs and hem', 'Soft, breathable interior', 'Machine washable'])
            ],
            [
                'id' => 2,
                'name' => 'Blue Tractor Sweatshirt',
                'price' => 1399,
                'old_price' => 1699,
                'description' => 'A playful blue long-sleeve sweatshirt with colorful tractor patterns. Designed for active little boys who love adventure.',
                'image_path' => 'assets/images/products/media__1785749417508_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Soft loopback cotton terry', 'Vibrant pattern print', 'Stretchy crewneck for easy dressing', 'Durable double-stitched seams'])
            ],
            [
                'id' => 3,
                'name' => 'Grey Little Things Sweatshirt',
                'price' => 1450,
                'old_price' => 1799,
                'description' => 'An adorable grey sweatshirt featuring a beautiful butterfly design and "LITTLE THINGS" lettering. Soft, gentle, and absolutely charming.',
                'image_path' => 'assets/images/products/media__1785749433662_front.jpg',
                'category' => 'Little Girls',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Premium cotton blend', 'Delicate butterfly graphic print', 'Ribbed neckline and cuffs', 'Warm and snug fit'])
            ],
            [
                'id' => 4,
                'name' => 'Navy Geometric Dino Sweatshirt',
                'price' => 1399,
                'old_price' => 1699,
                'description' => 'A cool navy blue sweatshirt featuring a geometric line-art dinosaur. Stylish, modern, and very comfortable.',
                'image_path' => 'assets/images/products/media__1785749452186_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['High-quality fleece fabric', 'Modern geometric graphic', 'Durable ribbing', 'Ideal for outdoor playtime'])
            ],
            [
                'id' => 5,
                'name' => 'Lavender Butterfly Sweatshirt',
                'price' => 1499,
                'old_price' => 1850,
                'description' => 'A lovely lavender sweatshirt detailed with a large, beautifully patterned butterfly. Perfect for little girls who love pretty details.',
                'image_path' => 'assets/images/products/media__1785749462105_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Ultra-soft cotton blend', 'Detailed butterfly graphic', 'Pastel lavender color shade', 'Cozy fleece lining'])
            ],
            [
                'id' => 6,
                'name' => 'Red Butterfly Sweatshirt',
                'price' => 1499,
                'old_price' => 1899,
                'description' => 'A vibrant red sweatshirt adorned with a delicate white and gold butterfly design. Adds a bright and cheerful touch to any outfit.',
                'image_path' => 'assets/images/products/media__1785749519451_front.jpg',
                'category' => 'Little Girls',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Bright red premium fleece', 'Soft gold-accented print', 'Comfortable stretch cuffs', 'Warm and durable fabric'])
            ],
            [
                'id' => 7,
                'name' => 'Yellow Los Angeles Sweatshirt',
                'price' => 1350,
                'old_price' => 1599,
                'description' => 'A bright yellow sweatshirt featuring a sleek "LOS ANGELES CALIFORNIA" graphic print. A trendy street-style look for little boys.',
                'image_path' => 'assets/images/products/media__1785749528451_front.jpg',
                'category' => 'Little Girls',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Premium breathable cotton', 'Stylish city silhouette graphic', 'Comfortable relaxed fit', 'Bright, fade-resistant color'])
            ],
            [
                'id' => 8,
                'name' => 'Camo Block Sweatshirt',
                'price' => 1499,
                'old_price' => 1799,
                'description' => 'A unique color-block sweatshirt with a grey top, camo patterned middle band, and navy blue bottom. Stylish and sporty.',
                'image_path' => 'assets/images/products/media__1785749550012_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Three-tone color blocking', 'Sporty camouflage details', 'Thick warm fleece fabric', 'Ribbed cuffs and waistband'])
            ],
            [
                'id' => 9,
                'name' => 'Forget The Rules Sweatshirt',
                'price' => 1450,
                'old_price' => 1750,
                'description' => 'A gorgeous peach sweatshirt featuring a gold star and "FORGET THE RULES" lettering. Gentle, stylish, and perfect for every day.',
                'image_path' => 'assets/images/products/media__1785749558563_front.jpg',
                'category' => 'Little Girls',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Soft pastel peach tone', 'Gold glitter star detailing', 'Relaxed fit for easy movement', 'Breathable cotton blend'])
            ],
            [
                'id' => 10,
                'name' => 'Orange Polka Dot Puffer Vest',
                'price' => 1899,
                'old_price' => 2499,
                'description' => 'A stylish orange puffer vest featuring cute tiny polka dots. Warm, lightweight, and perfect for layering over long sleeves.',
                'image_path' => 'assets/images/products/media__1785749567763_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Windproof outer shell', 'Cozy thermal insulation layer', 'Full front zip closure', 'Two side hand pockets'])
            ],
            [
                'id' => 11,
                'name' => 'Burgundy Awesome Sweatshirt',
                'price' => 1399,
                'old_price' => 1650,
                'description' => 'A rich burgundy sweatshirt featuring a bold "AWESOME" text design. Cozy and durable, perfect for cool autumn outings.',
                'image_path' => 'assets/images/products/media__1785749593723_front.jpg',
                'category' => 'Little Girls',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Premium loopback terry fabric', 'Deep burgundy shade', 'Bold minimal design', 'Shrink-resistant knit'])
            ],
            [
                'id' => 12,
                'name' => 'Orange Striped Knit Sweater',
                'price' => 1550,
                'old_price' => 1999,
                'description' => 'A classic knit sweater featuring peach/orange and white horizontal stripes. Super soft and lightweight.',
                'image_path' => 'assets/images/products/media__1785749604238_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Knitted cotton texture', 'Classic stripe pattern', 'Elastic ribbed hem and neck', 'Warm yet lightweight'])
            ],
            [
                'id' => 13,
                'name' => 'Purple Unicorns Sweatshirt',
                'price' => 1399,
                'old_price' => 1699,
                'description' => 'A dream-like light purple sweatshirt patterned with adorable unicorns, castles, and stars. Perfect for little princess vibes.',
                'image_path' => 'assets/images/products/media__1785749616021_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Soft-touch cotton fabric', 'Dreamy all-over unicorn print', 'Elasticated cuffs for a snug fit', 'Gentle on skin'])
            ],
            [
                'id' => 14,
                'name' => 'Peach Love Butterfly Sweatshirt',
                'price' => 1450,
                'old_price' => 1799,
                'description' => 'A cute peach sweatshirt detailed with a large butterfly and a sweet text layout. Cozy and beautiful.',
                'image_path' => 'assets/images/products/media__1785749624016_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Lovely peach-pink color', 'Chic butterfly graphic', 'Warm loopback lining', 'Comfortable crew neckline'])
            ],
            [
                'id' => 15,
                'name' => 'Dark Purple Butterfly Sweatshirt',
                'price' => 1499,
                'old_price' => 1899,
                'description' => 'A premium dark purple sweatshirt with a stunning white butterfly graphic. Combines high warmth with great style.',
                'image_path' => 'assets/images/products/media__1785749632165_front.jpg',
                'category' => 'Little Girls',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Rich deep purple shade', 'Crisp white butterfly details', 'Double-stitched seams', 'High-grade cotton fleece'])
            ],
            [
                'id' => 16,
                'name' => 'Grey Little Things Sweatshirt',
                'price' => 1450,
                'old_price' => 1799,
                'description' => 'An adorable grey sweatshirt featuring a beautiful butterfly design and "LITTLE THINGS" lettering. Soft, gentle, and absolutely charming.',
                'image_path' => 'assets/images/products/media__16_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Premium cotton blend', 'Delicate butterfly graphic print', 'Ribbed neckline and cuffs', 'Warm and snug fit'])
            ],
            [
                'id' => 17,
                'name' => 'Trendy Boys Sweatshirt',
                'price' => 1499,
                'old_price' => 1899,
                'description' => 'A trendy and comfortable sweatshirt designed specially for little boys. Perfect for everyday casual wear.',
                'image_path' => 'assets/images/products/media__17_front.jpg',
                'category' => 'Little Boys',
                'sizes' => json_encode(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y']),
                'features' => json_encode(['Soft and warm fabric', 'Trendy modern design', 'Durable stitching', 'Comfortable fit'])
            ]
        ];

        \Illuminate\Support\Facades\DB::table('products')->insert($products);
    }
}
