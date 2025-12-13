<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            text-align: center;
        }
        .otp-code {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            background: white;
            padding: 20px;
            border-radius: 10px;
            letter-spacing: 8px;
            margin: 20px 0;
            border: 2px dashed #667eea;
        }
        .warning {
            color: #dc2626;
            font-size: 14px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Verification Code</h1>
    </div>
    <div class="content">
        <h2>Your CineWave Verification Code</h2>
        <p>Use this code to verify your email address:</p>
        <div class="otp-code">{{ $otp }}</div>
        <p>This code will expire in 10 minutes.</p>
        <p class="warning">If you didn't request this code, please ignore this email.</p>
    </div>
    <div class="footer">
        <p>© {{ date('Y') }} CineWave. All rights reserved.</p>
        <p>This email was sent to {{ $email }}</p>
    </div>
</body>
</html>
