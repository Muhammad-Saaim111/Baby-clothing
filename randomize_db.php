<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$products = \App\Models\Product::all();
$ageRanges = ['0 - 12 Months', '1 - 2 Years', '2 - 4 Years', '2 - 6 Years', '4 - 8 Years'];

foreach ($products as $product) {
    $product->age_range = $ageRanges[array_rand($ageRanges)];
    $product->rating = mt_rand(35, 50) / 10; // Random rating between 3.5 and 5.0
    $product->review_count = mt_rand(10, 300);
    $product->save();
}

echo "Database successfully randomized!\n";
