<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f5f0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; }
        h1 { color: #d07b66; text-align: center; }
        .coupon-box { background-color: #fff4f1; border: 2px dashed #d07b66; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; color: #d07b66; margin: 20px 0; border-radius: 8px; }
        .btn { display: inline-block; background-color: #d07b66; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Here is {{ $discountPercent }}% OFF!</h1>
        <p>Hi there,</p>
        <p>We know you loved those items in your cart. To make it even sweeter, here is an exclusive discount just for you!</p>
        
        <div class="coupon-box">
            {{ $couponCode }}
        </div>

        <p>Use this code at checkout to claim your {{ $discountPercent }}% discount.</p>

        <div style="text-align: center;">
            <a href="{{ url('/checkout') }}" class="btn">Complete My Purchase</a>
        </div>
    </div>
</body>
</html>
