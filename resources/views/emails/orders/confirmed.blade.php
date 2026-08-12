<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #faf8f5;
            color: #1c221e;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid #e5e7eb;
        }
        .header {
            background-color: #1c221e;
            color: #ffffff;
            text-align: center;
            padding: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 1.8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .header span {
            color: #d39e82;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .thank-you {
            color: #6b7280;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .order-meta {
            background: #faf8f5;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid #f6d8c3;
        }
        .od-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        .od-row:last-child {
            margin-bottom: 0;
        }
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .item-table th {
            text-align: left;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6b7280;
        }
        .item-table td {
            padding: 15px 0;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.95rem;
        }
        .totals-section {
            width: 50%;
            margin-left: auto;
            margin-bottom: 30px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 0.95rem;
        }
        .total-row.grand-total {
            font-weight: 700;
            font-size: 1.1rem;
            border-top: 1px solid #e5e7eb;
            padding-top: 12px;
            color: #1c221e;
        }
        .shipping-details {
            border-top: 1px solid #e5e7eb;
            padding-top: 30px;
            margin-top: 30px;
        }
        .shipping-details h3 {
            font-size: 1rem;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #d39e82;
        }
        .shipping-details p {
            margin: 4px 0;
            color: #6b7280;
            font-size: 0.95rem;
        }
        .footer {
            background-color: #faf8f5;
            text-align: center;
            padding: 20px;
            font-size: 0.8rem;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>AI<span>MÉE</span></h1>
        </div>
        <div class="content">
            <div class="greeting">Hi {{ $order->first_name }},</div>
            <p class="thank-you">Thank you for your order! We've received your order and are processing it. We will notify you once it ships.</p>
            
            <div class="order-meta">
                <div class="od-row">
                    <span>Order Number:</span>
                    <strong>{{ $order->order_number }}</strong>
                </div>
                <div class="od-row">
                    <span>Payment Method:</span>
                    <span>Cash on Delivery (COD)</span>
                </div>
                <div class="od-row">
                    <span>Date:</span>
                    <span>{{ $order->created_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>

            <table class="item-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div><strong>{{ $item->product_name }}</strong></div>
                                <div style="font-size: 0.8rem; color: #6b7280;">Size: {{ $item->size }}</div>
                            </td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right;">Rs. {{ number_format($item->price * $item->quantity) }}.00</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="totals-section">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>Rs. {{ number_format($order->subtotal) }}.00</span>
                </div>
                @if($order->discount > 0)
                    <div class="total-row" style="color: #ff4747;">
                        <span>Discount ({{ $order->coupon_code }}):</span>
                        <span>-Rs. {{ number_format($order->discount) }}.00</span>
                    </div>
                @endif
                <div class="total-row">
                    <span>Shipping:</span>
                    <span>{{ $order->shipping > 0 ? 'Rs. ' . number_format($order->shipping) . '.00' : 'Free' }}</span>
                </div>
                <div class="total-row grand-total">
                    <span>Total:</span>
                    <span>Rs. {{ number_format($order->total) }}.00</span>
                </div>
            </div>

            <div class="shipping-details">
                <h3>Delivery Details</h3>
                <p><strong>{{ $order->first_name }} {{ $order->last_name }}</strong></p>
                <p>{{ $order->address }}</p>
                @if($order->apartment)
                    <p>{{ $order->apartment }}</p>
                @endif
                <p>{{ $order->city }}, {{ $order->postal_code }}</p>
                <p>Phone: {{ $order->phone }}</p>
            </div>
            
            @if($order->special_instructions)
                <div class="shipping-details" style="border-top: none; padding-top: 15px; margin-top: 15px;">
                    <h3 style="color: #6b7280; font-size: 0.9rem;">Special Instructions</h3>
                    <p style="font-style: italic;">"{{ $order->special_instructions }}"</p>
                </div>
            @endif
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} AiM'EE. All rights reserved.</p>
            <p>Need help? Contact us at support@aimee.com</p>
        </div>
    </div>
</body>
</html>
