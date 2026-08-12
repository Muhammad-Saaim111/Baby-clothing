<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Outfit', Arial, sans-serif; background-color: #fdfbf7; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #eaeaea; }
        h2 { color: #333; font-weight: 600; text-align: center; }
        p { color: #555; line-height: 1.6; }
        .btn { display: inline-block; background-color: #d4a373; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 30px; font-weight: 600; margin-top: 20px; }
        .product-box { border: 1px solid #eee; padding: 15px; border-radius: 8px; text-align: center; margin: 20px 0; }
        .product-box img { max-width: 150px; border-radius: 6px; }
        .footer { text-align: center; margin-top: 30px; font-size: 0.9em; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <h2>How did we do?</h2>
        <p>Hi {{ $order->first_name }},</p>
        <p>We hope you and your little one are loving the <strong>{{ $product->name }}</strong>!</p>
        <p>Your opinion means the world to us and helps other parents make the best choices. Could you take a moment to share your experience?</p>
        
        <div class="product-box">
            @if($product->image_path)
                <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
            @endif
            <h4>{{ $product->name }}</h4>
            <a href="{{ $reviewUrl }}" class="btn">Leave a Review</a>
        </div>

        <p>Thank you for shopping with BabyClothing!</p>
        
        <div class="footer">
            <p>If you have any questions or issues with your order, please contact our support team.</p>
        </div>
    </div>
</body>
</html>
