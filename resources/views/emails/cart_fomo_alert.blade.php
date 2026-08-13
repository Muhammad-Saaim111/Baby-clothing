<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f5f0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; border-top: 4px solid #e74c3c; }
        h1 { color: #e74c3c; text-align: center; }
        .btn { display: inline-block; background-color: #e74c3c; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Cart is Expiring Soon!</h1>
        <p>Hi there,</p>
        <p>This is your last chance! Your cart and the special discount code we sent you will expire in 30 minutes.</p>
        <p>Don't miss out on these amazing items for your little one.</p>
        
        <div style="text-align: center;">
            <a href="{{ url('/checkout') }}" class="btn">Shop Now Before It's Gone</a>
        </div>
    </div>
</body>
</html>
