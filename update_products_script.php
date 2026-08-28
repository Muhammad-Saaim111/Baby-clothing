<?php
$products = \App\Models\Product::all();
foreach ($products as $product) {
    // Generate age range based on category logic
    $ageRange = '2 - 6 Years';
    if (str_contains($product->category ?? '', 'New Born')) {
        $ageRange = '0 - 12 Months';
    } elseif (str_contains($product->category ?? '', 'Accessories')) {
        $ageRange = 'One Size / Kids';
    }
    
    $product->age_range = $ageRange;
    $product->rating = mt_rand(40, 50) / 10; // Random rating between 4.0 and 5.0
    $product->review_count = mt_rand(5, 120);
    $product->save();
}
echo "Products updated successfully!\n";
