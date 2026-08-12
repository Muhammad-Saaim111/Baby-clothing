<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - AiM'EE</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');
        
        body {
            margin: 0;
            padding: 0;
            background-color: #faf6f0;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        
        table {
            border-spacing: 0;
            border-collapse: collapse;
            width: 100%;
        }
        
        td {
            padding: 0;
        }
        
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #faf6f0;
            padding-bottom: 60px;
        }
        
        .main-table {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 550px;
            border-radius: 24px;
            border: 1px solid #f3ece6;
            box-shadow: 0 8px 30px rgba(74, 62, 61, 0.03);
            overflow: hidden;
        }
        
        .header {
            padding: 40px 0 20px 0;
            text-align: center;
        }
        
        .logo {
            height: 48px;
            width: auto;
            display: inline-block;
        }
        
        .content {
            padding: 20px 45px 40px 45px;
            text-align: center;
        }
        
        h1 {
            color: #2b2524;
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 15px 0;
            letter-spacing: -0.5px;
        }
        
        p {
            color: #615553;
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 25px 0;
        }
        
        .button-container {
            margin: 30px 0;
            text-align: center;
        }
        
        .btn-verify {
            background-color: #f37a65;
            color: #ffffff !important;
            display: inline-block;
            padding: 14px 36px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 20px rgba(243, 122, 101, 0.25);
            transition: all 0.3s ease;
        }
        
        .divider {
            height: 1px;
            background-color: #f3ece6;
            margin: 35px 0 25px 0;
        }
        
        .footer-text {
            color: #a39592;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
        }
        
        .footer-text a {
            color: #f37a65;
            text-decoration: none;
        }
        
        .subcopy {
            text-align: left;
            background-color: #faf6f0;
            padding: 15px 20px;
            border-radius: 12px;
            margin-top: 25px;
        }
        
        .subcopy-text {
            font-size: 12px;
            color: #8c7e7b;
            line-height: 1.5;
            word-break: break-all;
            margin: 0;
        }
    </style>
</head>
<body>
    <table class="wrapper" role="presentation">
        <tr>
            <td align="center">
                <!-- Outer Spacing -->
                <table style="width: 100%; max-width: 550px;" role="presentation">
                    <tr>
                        <td style="padding: 40px 0 20px 0; text-align: center;">
                            <!-- Embedded CID Logo -->
                            <img src="{{ $message->embed(public_path('assets/images/logo_clean.png')) }}" alt="AiM'EE Logo" class="logo">
                        </td>
                    </tr>
                </table>
                
                <!-- Main Email Card -->
                <table class="main-table" role="presentation">
                    <tr>
                        <td class="content">
                            <h1>Welcome to AiM'EE! 🌸</h1>
                            <p>Thank you for creating an account with us. To start exploring our premium baby wear collections, please verify your email address by clicking the button below.</p>
                            
                            <!-- Button -->
                            <div class="button-container">
                                <a href="{{ $url }}" class="btn-verify" target="_blank">Verify Email Address</a>
                            </div>
                            
                            <p style="margin-bottom: 0;">If you did not create an account, no further action is required.</p>
                            
                            <div class="divider"></div>
                            
                            <p class="footer-text">
                                Regards,<br>
                                <strong>Team AiM'EE</strong>
                            </p>
                            
                            <!-- Subcopy/Alternative Link -->
                            <div class="subcopy">
                                <p class="subcopy-text">
                                    If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
                                </p>
                                <p class="subcopy-text" style="margin-top: 5px;">
                                    <a href="{{ $url }}" style="color: #f37a65;">{{ $url }}</a>
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
                
                <!-- Footer Info -->
                <table style="width: 100%; max-width: 550px;" role="presentation">
                    <tr>
                        <td style="padding: 30px 20px 0 20px; text-align: center;">
                            <p class="footer-text" style="color: #bfaea9;">
                                © {{ date('Y') }} AiM'EE. All rights reserved.<br>
                                Handcrafted for comfort, designed for style.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
