<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $code     = strtoupper(trim($request->input('code', '')));
        $subtotal = floatval($request->input('subtotal', 0));

        if (!$code) {
            return response()->json(['success' => false, 'message' => 'Please enter a coupon code.'], 422);
        }

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code. Please try again.'], 404);
        }

        if (!$coupon->isValid()) {
            return response()->json(['success' => false, 'message' => 'This coupon has expired or is no longer active.'], 422);
        }

        if ($subtotal < $coupon->min_order_amount) {
            return response()->json([
                'success' => false,
                'message' => "This coupon requires a minimum order of Rs. " . number_format($coupon->min_order_amount) . ".",
            ], 422);
        }

        $discount = $coupon->calculateDiscount($subtotal);
        $label    = $coupon->type === 'percentage'
            ? "{$coupon->value}% off"
            : "Rs. " . number_format($coupon->value) . " off";

        return response()->json([
            'success'   => true,
            'message'   => "Coupon \"{$coupon->code}\" applied! You save {$label}.",
            'code'      => $coupon->code,
            'type'      => $coupon->type,
            'value'     => $coupon->value,
            'discount'  => $discount,
        ]);
    }
}
