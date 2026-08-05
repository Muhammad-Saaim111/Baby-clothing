<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::all();
    return view('home', compact('products'));
});

Route::get('/product/{id}', function ($id) {
    $product = Product::findOrFail($id);
    
    // Find related products (same category, excluding current one)
    $related = Product::where('category', $product->category)
                      ->where('id', '!=', $product->id)
                      ->take(4)
                      ->get();
    
    return view('product', compact('product', 'related'));
})->name('product.show');

Route::get('/category/{gender}', function ($gender) {
    $category_name = '';
    if ($gender === 'little-boys') {
        $category_name = 'Little Boys';
    } elseif ($gender === 'little-girls') {
        $category_name = 'Little Girls';
    } elseif ($gender === 'shirts') {
        $category_name = 'All Shirts';
    } else {
        abort(404);
    }
    
    if ($gender === 'shirts') {
        $products = Product::all();
    } else {
        $products = Product::where('category', $category_name)->get();
    }
    
    return view('category', [
        'category' => $category_name,
        'gender_slug' => $gender,
        'products' => $products
    ]);
})->name('category.show');
