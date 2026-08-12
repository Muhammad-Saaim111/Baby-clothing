<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'reviewer_name'  => 'required|string|max:255',
            'reviewer_email' => 'required|email|max:255',
            'rating'         => 'required|integer|min:1|max:5',
            'review_title'   => 'nullable|string|max:255',
            'review_text'    => 'required|string|min:5',
        ]);

        $product = Product::findOrFail($productId);

        // Check if the user is a verified buyer of this product
        $email = trim($request->input('reviewer_email'));
        $isVerified = false;

        // Fetch all order IDs for this email
        $orderIds = DB::table('orders')
            ->where('email', 'like', $email)
            ->pluck('id');

        if ($orderIds->isNotEmpty()) {
            // Check if any of those orders contain this product
            $bought = DB::table('order_items')
                ->whereIn('order_id', $orderIds)
                ->where('product_id', (string)$productId)
                ->exists();

            if ($bought) {
                $isVerified = true;
            }
        }

        // Create the review
        Review::create([
            'product_id'     => $product->id,
            'user_id'        => Auth::id(), // null if guest
            'rating'         => $request->input('rating'),
            'reviewer_name'  => $request->input('reviewer_name'),
            'reviewer_email' => $email,
            'review_title'   => $request->input('review_title'),
            'review_text'    => $request->input('review_text'),
            'is_verified'    => $isVerified,
        ]);

        return redirect()->back()->with('review_success', 'Thank you for your feedback! Your review has been published.');
    }
}
