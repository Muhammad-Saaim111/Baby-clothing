<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f5f0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; }
        h1 { color: #d07b66; text-align: center; }
        .btn { display: inline-block; background-color: #d07b66; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Did you forget something?</h1>
        <p>Hi there,</p>
        <p>We noticed you left some lovely items in your cart. They're waiting for you!</p>
        <div style="text-align: center;">
            <a href="{{ url('/cart') }}" class="btn">View My Cart</a>
        </div>
        <p style="margin-top: 30px; font-size: 12px; color: #777;">If you have any questions, feel free to reply to this email.</p>
    </div>
</body>
</html>
