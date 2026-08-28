<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$products = \App\Models\Product::all();

foreach ($products as $product) {
    $product->rating = 0.0; 
    $product->review_count = 0;
    $product->save();
}

echo "Database ratings and reviews reset to zero!\n";
