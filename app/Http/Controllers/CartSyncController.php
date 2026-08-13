<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbandonedCart;
use Illuminate\Support\Facades\Auth;

class CartSyncController extends Controller
{
    public function sync(Request $request)
    {
        $cartData = $request->input('cart', []);
        $totalValue = $request->input('total', 0);
        $email = $request->input('email');
        
        $userId = Auth::check() ? Auth::id() : null;
        if ($userId && !$email) {
            $email = Auth::user()->email;
        }

        // Determine if we should track this user
        // We will track ALL carts, even if no user/email, so we can clear them later
        $cartId = $request->input('cart_id') ?? null;

        // Find existing active cart
        $query = AbandonedCart::whereIn('funnel_step', [0, 1, 2, 3]);
        
        if ($cartId) {
            $query->where('id', $cartId);
        } elseif ($userId) {
            $query->where('user_id', $userId);
        } elseif ($email) {
            $query->where('email', $email);
        } else {
            // New anonymous cart without email or user ID, we will just create it below
            // Force it to not find anything so it falls through to create
            $query->where('id', 0);
        }

        $abandonedCart = $query->first();

        // If cart is empty, they cleared their cart. We should mark it as cleared or delete.
        if (empty($cartData)) {
            if ($abandonedCart) {
                $abandonedCart->funnel_step = 4; // Cleared
                $abandonedCart->save();
            }
            return response()->json(['status' => 'cleared']);
        }

        if ($abandonedCart) {
            // Update existing
            $abandonedCart->cart_data = $cartData;
            $abandonedCart->total_value = $totalValue;
            $abandonedCart->last_active_at = now();
            // If they are active again, reset funnel if they were being marketed to?
            if ($abandonedCart->funnel_step > 0) {
                $abandonedCart->funnel_step = 0; // Restart funnel
            }
            
            if ($email && !$abandonedCart->email) {
                $abandonedCart->email = $email;
            }
            
            $abandonedCart->save();
        } else {
            // Create new
            $abandonedCart = AbandonedCart::create([
                'user_id' => $userId,
                'email' => $email,
                'cart_data' => $cartData,
                'total_value' => $totalValue,
                'funnel_step' => 0,
                'last_active_at' => now(),
            ]);
        }

        return response()->json([
            'status' => 'synced',
            'cart_id' => $abandonedCart->id
        ]);
    }

    public function checkStatus(Request $request)
    {
        $email = $request->input('email');
        $cartId = $request->input('cart_id');
        $userId = Auth::check() ? Auth::id() : null;

        \Log::info("checkStatus called with email: {$email}, cart_id: {$cartId}, userId: {$userId}");

        if (!$userId && !$email && !$cartId) {
            \Log::info("checkStatus returning false due to missing identifiers");
            return response()->json(['cleared' => false]);
        }

        $query = AbandonedCart::query();
        
        if ($cartId) {
            $query->where('id', $cartId);
        } elseif ($userId) {
            $query->where('user_id', $userId);
        } elseif ($email) {
            $query->where('email', $email);
        } else {
            // New anonymous cart without email or user ID, we will just create it below
            // Force it to not find anything so it falls through to create
            $query->where('id', 0);
        }

        // Get the latest cart entry
        $cart = $query->orderBy('updated_at', 'desc')->first();

        if ($cart) {
            \Log::info("checkStatus found cart {$cart->id} with funnel_step {$cart->funnel_step}");
        } else {
            \Log::info("checkStatus found no cart");
        }

        // If funnel_step == 4 (cleared) or 5 (recovered)
        if ($cart && in_array($cart->funnel_step, [4, 5])) {
            \Log::info("checkStatus returning true");
            return response()->json(['cleared' => true]);
        }

        \Log::info("checkStatus returning false at end");
        return response()->json(['cleared' => false]);
    }
}
