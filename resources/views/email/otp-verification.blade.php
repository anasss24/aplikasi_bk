<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .content {
            padding: 2rem;
        }
        .otp-code {
            background: #f8f9fa;
            border: 2px dashed #667eea;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            margin: 1.5rem 0;
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            letter-spacing: 0.5rem;
        }
        .footer {
            background: #f8f9fa;
            padding: 1rem 2rem;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Aplikasi BK</div>
            <h1>Verifikasi OTP</h1>
        </div>
        
        <div class="content">
            <p>Halo <strong>{{ $userName }}</strong>,</p>
            
            <p>Terima kasih telah mendaftar di Aplikasi BK SMK ANTARTIKA 1. Gunakan kode OTP berikut untuk verifikasi akun Anda:</p>
            
            <div class="otp-code">
                {{ $otpCode }}
            </div>
            
            <p><strong>Perhatian:</strong></p>
            <ul>
                <li>Kode OTP berlaku selama <strong>10 menit</strong></li>
                <li>Jangan bagikan kode ini kepada siapapun</li>
                <li>Jika Anda tidak merasa melakukan registrasi, abaikan email ini</li>
            </ul>
            
            <p>Jika Anda mengalami kendala, silakan hubungi administrator.</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Aplikasi BK - SMK ANTARTIKA 1 Buduran Sidoarjo. All rights reserved.</p>
        </div>
    </div>
</body>
</html>