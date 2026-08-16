<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CouponController;


Route::post('/login/ajax', [AuthController::class, 'login'])->name('login.ajax');
Route::post('/register/ajax', [AuthController::class, 'register'])->name('register.ajax');
Route::post('/logout/ajax', [AuthController::class, 'logout'])->name('logout.ajax');

// Google OAuth Routes
Route::get('/auth/google', [\App\Http\Controllers\GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [\App\Http\Controllers\GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/orders', [\App\Http\Controllers\ProfileController::class, 'orders'])->name('orders');
});

// Custom Email Verification Route (No Auth required)
Route::get('/email/verify/{id}/{hash}', function ($id, $hash, \Illuminate\Http\Request $request) {
    $user = \App\Models\User::findOrFail($id);

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403);
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new \Illuminate\Auth\Events\Verified($user));
    }

    // Automatically log in the user upon verification
    \Illuminate\Support\Facades\Auth::login($user);
    $request->session()->regenerate();

    return redirect('/?verified=1');
})->middleware(['signed'])->name('verification.verify');
Route::post('/checkout/place', [\App\Http\Controllers\CheckoutController::class, 'placeOrder'])->name('checkout.place');
Route::post('/coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');
Route::post('/api/cart/sync', [\App\Http\Controllers\CartSyncController::class, 'sync'])->name('cart.sync');
Route::post('/api/cart/check', [\App\Http\Controllers\CartSyncController::class, 'checkStatus'])->name('cart.check');

Route::get('/search', function (\Illuminate\Http\Request $request) {
    $q = trim($request->input('q', ''));
    $products = collect();
    if ($q) {
        $products = Product::where('is_active', true)
            ->where(function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%")
                      ->orWhere('category', 'like', "%{$q}%");
            })
            ->paginate(12);
    }
    return view('search', compact('products', 'q'));
})->name('search');

Route::get('/wishlist', function () {
    return view('wishlist');
})->name('wishlist');

Route::get('/', function () {
    $products = Product::where('is_active', true)->get();
    $deals = \App\Models\Deal::all();
    return view('home', compact('products', 'deals'));
});

Route::get('/product/{id}', function ($id) {
    $product = Product::with('reviews')->where('is_active', true)->findOrFail($id);
    
    // Find related products (same category, excluding current one)
    $related = Product::where('is_active', true)
                      ->where('category', $product->category)
                      ->where('id', '!=', $product->id)
                      ->take(4)
                      ->get();
    
    return view('product', compact('product', 'related'));
})->name('product.show');

Route::get('/product/{product}/review', \App\Livewire\SubmitReview::class)
    ->name('review.create')
    ->middleware('signed');

// Old route (can be removed or kept for fallback)
// Route::post('/product/{id}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
Route::get('/category/{gender}', function ($gender) {
    $category_name = '';
    if ($gender === 'little-boys') {
        $category_name = 'Little Boys';
    } elseif ($gender === 'little-girls') {
        $category_name = 'Little Girls';
    } elseif ($gender === 'new-born') {
        $category_name = 'New Born';
    } elseif ($gender === 'shirts') {
        $category_name = 'All Shirts';
    } else {
        abort(404);
    }
    
    if ($gender === 'shirts') {
        $products = Product::where('is_active', true)->get();
    } elseif ($gender === 'new-born') {
        // Fetch products with smaller sizes like 1-2Y to populate newborn catalog
        $products = Product::where('is_active', true)->where('sizes', 'like', '%1-2Y%')->take(6)->get();
    } else {
        $products = Product::where('is_active', true)->where('category', $category_name)->get();
    }
    
    return view('category', [
        'category' => $category_name,
        'gender_slug' => $gender,
        'products' => $products
    ]);
})->name('category.show');

Route::get('/wishlist', function () {
    return view('wishlist');
})->name('wishlist');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/easypaisa/payment', [\App\Http\Controllers\CheckoutController::class, 'easypaisaGateway'])->name('easypaisa.gateway');
Route::post('/easypaisa/callback', [\App\Http\Controllers\CheckoutController::class, 'easypaisaCallback'])->name('easypaisa.callback');

Route::get('/clear', function() {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return "Cache cleared successfully!";
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', \App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
    Route::get('/products', \App\Livewire\Admin\Products::class)->name('admin.products');
    Route::get('/coupons', \App\Livewire\Admin\Coupons::class)->name('admin.coupons');
    Route::get('/customers', \App\Livewire\Admin\Customers::class)->name('admin.customers');
    Route::get('/orders', \App\Livewire\Admin\Orders::class)->name('admin.orders');
    Route::get('/marketing', \App\Livewire\Admin\Marketing::class)->name('admin.marketing');
    Route::get('/reviews', \App\Livewire\Admin\Reviews::class)->name('admin.reviews');
    Route::get('/banners', \App\Livewire\Admin\Banners::class)->name('admin.banners');
    Route::get('/deals', \App\Livewire\Admin\Deals::class)->name('admin.deals');
});
