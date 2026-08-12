<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easypaisa Checkout - Secure Payment</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --ep-green: #3fb54f;
            --ep-dark-green: #2d8c39;
            --ep-bg: #f4f6f8;
            --ep-text: #2d3748;
            --ep-border: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--ep-bg);
            color: var(--ep-text);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .gateway-container {
            background: #ffffff;
            width: 100%;
            max-width: 480px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--ep-border);
            overflow: hidden;
        }

        .gateway-header {
            background: linear-gradient(135deg, var(--ep-green), var(--ep-dark-green));
            color: white;
            padding: 30px 24px;
            text-align: center;
            position: relative;
        }

        .gateway-header img {
            height: 45px;
            margin-bottom: 12px;
        }

        .gateway-header h2 {
            font-size: 1.25rem;
            font-weight: 500;
            opacity: 0.95;
        }

        .order-summary-box {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 15px;
            margin-top: 15px;
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-summary-box span {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .order-summary-box strong {
            font-size: 1.15rem;
            font-weight: 600;
        }

        .gateway-body {
            padding: 30px 24px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.92rem;
            color: #718096;
            border-bottom: 1px dashed var(--ep-border);
            padding-bottom: 8px;
        }

        .info-row strong {
            color: var(--ep-text);
        }

        .payment-method-selector {
            margin-top: 25px;
        }

        .method-title {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #718096;
            margin-bottom: 12px;
        }

        .method-card {
            border: 2px solid var(--ep-green);
            border-radius: 12px;
            padding: 16px;
            background: #fafdff;
            margin-bottom: 20px;
        }

        .method-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: var(--ep-dark-green);
            font-size: 1.05rem;
        }

        .method-card-header i {
            font-size: 1.2rem;
        }

        .form-group {
            margin-top: 15px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper span {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 12px 12px 50px;
            border: 1px solid var(--ep-border);
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: var(--ep-text);
            outline: none;
            transition: border-color 0.2s;
        }

        .input-wrapper input:focus {
            border-color: var(--ep-green);
        }

        .helper-text {
            font-size: 0.78rem;
            color: #718096;
            margin-top: 6px;
            line-height: 1.4;
        }

        .pay-btn {
            width: 100%;
            background: var(--ep-green);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 30px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            box-shadow: 0 4px 12px rgba(63, 181, 79, 0.25);
            margin-top: 10px;
        }

        .pay-btn:hover {
            background: var(--ep-dark-green);
            transform: translateY(-1px);
        }

        .pay-btn:active {
            transform: translateY(1px);
        }

        .cancel-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #a0aec0;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .cancel-link:hover {
            color: #718096;
        }

        .secure-badge {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            color: #a0aec0;
            margin-top: 25px;
        }

        .secure-badge i {
            color: var(--ep-green);
        }
    </style>
</head>
<body>

<div class="gateway-container">
    <!-- Header -->
    <div class="gateway-header">
        <div style="font-size: 1.8rem; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 5px;">
            easy<span style="color: #e5f9e7; font-weight: 400;">paisa</span>
        </div>
        <h2>Secure Hosted Checkout</h2>
        
        <div class="order-summary-box">
            <span>Amount to Pay</span>
            <strong>Rs. {{ number_format($order->total) }}.00</strong>
        </div>
    </div>

    <!-- Body -->
    <div class="gateway-body">
        <div class="info-row">
            <span>Order Reference</span>
            <strong>#{{ $order->order_number }}</strong>
        </div>
        <div class="info-row">
            <span>Merchant</span>
            <strong>AIMEE Kidswear</strong>
        </div>
        <div class="info-row">
            <span>Customer</span>
            <strong>{{ $order->first_name }} {{ $order->last_name }}</strong>
        </div>

        <div class="payment-method-selector">
            <div class="method-title">Choose Payment Mode</div>
            <div class="method-card">
                <div class="method-card-header">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                    <span>Easypaisa Mobile Wallet</span>
                </div>
                
                <form action="{{ route('easypaisa.callback') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_number" value="{{ $order->order_number }}">
                    
                    <div class="form-group">
                        <label for="mobile_number">Enter Easypaisa Mobile Account Number</label>
                        <div class="input-wrapper">
                            <span>+92</span>
                            <input type="text" name="mobile_number" id="mobile_number" placeholder="3XXXXXXXXX" required pattern="3[0-9]{9}" maxlength="10">
                        </div>
                        <p class="helper-text">Please make sure your mobile account is active and has sufficient balance. You will receive an approval prompt or OTP shortly.</p>
                    </div>

                    <button type="submit" class="pay-btn">PAY SECURELY</button>
                </form>
            </div>
        </div>

        <a href="{{ route('checkout') }}" class="cancel-link">Cancel Transaction</a>

        <div class="secure-badge">
            <i class="fa-solid fa-shield-halved"></i>
            <span>Secured by Telenor Microfinance Bank. SSL 128-bit Encryption.</span>
        </div>
    </div>
</div>

</body>
</html>
