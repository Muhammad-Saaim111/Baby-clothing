<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'apartment' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'required|string|regex:/^[0-9]{10,12}$/',
            'payment_method' => 'required|string|in:COD,Easypaisa',
            'subtotal' => 'required|numeric',
            'discount' => 'required|numeric',
            'shipping' => 'required|numeric',
            'total' => 'required|numeric',
            'coupon_code' => 'nullable|string|max:50',
            'special_instructions' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|string',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.size' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error. Please verify your details.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Generate unique order number (e.g., AIM-839420)
        $orderNumber = 'AIM-' . rand(100000, 999999);
        while (Order::where('order_number', $orderNumber)->exists()) {
            $orderNumber = 'AIM-' . rand(100000, 999999);
        }

        // Create Order
        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => Auth::id(), // Null if checked out as guest
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'apartment' => $request->apartment,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'subtotal' => $request->subtotal,
            'discount' => $request->discount,
            'shipping' => $request->shipping,
            'total' => $request->total,
            'coupon_code' => $request->coupon_code,
            'special_instructions' => $request->special_instructions,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        // Create Order Items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'size' => $item['size'],
            ]);
        }

        if ($request->payment_method === 'Easypaisa') {
            // For Easypaisa, we return a redirect URL to our mockup gateway instead of sending email now
            return response()->json([
                'success' => true,
                'message' => 'Order created. Redirecting to payment gateway...',
                'order_number' => $order->order_number,
                'total' => $order->total,
                'redirect_url' => route('easypaisa.gateway', ['order_number' => $order->order_number])
            ]);
        }

        // Send Email Confirmation for COD immediately
        try {
            Mail::to($order->email)->send(new OrderConfirmed($order));
        } catch (\Exception $e) {
            // Log mail failures to avoid blocking the checkout response
            logger()->error('Order confirmation email failed to send: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_number' => $order->order_number,
            'total' => $order->total,
        ]);
    }

    /**
     * Renders the Mock Easypaisa Checkout Page
     */
    public function easypaisaGateway(Request $request)
    {
        $order = Order::where('order_number', $request->order_number)->firstOrFail();
        return view('easypaisa_gateway', compact('order'));
    }

    /**
     * Handles simulated Easypaisa callback redirection
     */
    public function easypaisaCallback(Request $request)
    {
        $order = Order::where('order_number', $request->order_number)->firstOrFail();
        
        // Update status to Paid/Completed
        $order->status = 'completed'; // or 'paid'
        // Let's store reference id
        $order->payment_method = 'Easypaisa';
        $order->save();

        // Send confirmation email
        try {
            Mail::to($order->email)->send(new OrderConfirmed($order));
        } catch (\Exception $e) {
            logger()->error('Order confirmation email failed to send on payment success: ' . $e->getMessage());
        }

        // Redirect back to checkout success modal trigger
        return redirect()->route('checkout', [
            'order_success' => '1',
            'order_number' => $order->order_number,
            'total' => $order->total,
            'email' => $order->email
        ]);
    }
}
