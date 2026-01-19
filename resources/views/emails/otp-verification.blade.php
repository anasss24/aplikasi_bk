<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi OTP</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #ffffff;
      padding: 30px;
      text-align: center;
    }

    .header h1 {
      margin: 0;
      font-size: 28px;
      font-weight: bold;
    }

    .content {
      padding: 30px;
      text-align: center;
    }

    .greeting {
      font-size: 16px;
      margin-bottom: 20px;
      color: #333;
    }

    .otp-box {
      background-color: #f9f9f9;
      border: 2px solid #667eea;
      border-radius: 8px;
      padding: 20px;
      margin: 30px 0;
    }

    .otp-label {
      font-size: 14px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 10px;
    }

    .otp-code {
      font-size: 36px;
      font-weight: bold;
      color: #667eea;
      letter-spacing: 5px;
      font-family: 'Courier New', monospace;
    }

    .note {
      font-size: 14px;
      color: #999;
      margin-top: 20px;
      font-style: italic;
    }

    .instructions {
      background-color: #f0f4ff;
      border-left: 4px solid #667eea;
      padding: 15px;
      margin: 20px 0;
      text-align: left;
      font-size: 14px;
      color: #333;
    }

    .instructions ul {
      margin: 10px 0;
      padding-left: 20px;
    }

    .instructions li {
      margin: 8px 0;
    }

    .footer {
      background-color: #f9f9f9;
      padding: 20px;
      text-align: center;
      font-size: 12px;
      color: #999;
      border-top: 1px solid #eee;
    }

    .button-group {
      margin: 20px 0;
    }

    .warning {
      color: #d9534f;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <h1>✓ Verifikasi Akun Anda</h1>
    </div>

    <!-- Content -->
    <div class="content">
      <div class="greeting">
        Halo <strong>{{ $userName }}</strong>,
      </div>

      <p style="color: #666; margin-bottom: 20px;">
        Terima kasih telah mendaftar di Aplikasi BK. Silakan gunakan kode OTP di bawah ini untuk memverifikasi akun
        Anda.
      </p>

      <!-- OTP Box -->
      <div class="otp-box">
        <div class="otp-label">Kode Verifikasi Anda</div>
        <div class="otp-code">{{ $otpCode }}</div>
        <div class="note">Kode ini berlaku selama 10 menit</div>
      </div>

      <!-- Instructions -->
      <div class="instructions">
        <strong style="color: #667eea;">Cara menggunakan kode OTP:</strong>
        <ul>
          <li>Salin kode OTP di atas</li>
          <li>Kembali ke aplikasi Aplikasi BK</li>
          <li>Masukkan kode OTP pada kolom yang tersedia</li>
          <li>Klik tombol "Verifikasi OTP"</li>
        </ul>
      </div>

      <!-- Warning -->
      <p style="margin: 30px 0;">
        <span class="warning">⚠️ Jangan bagikan kode OTP ini kepada siapapun!</span>
        <br>
        <small style="color: #999;">Kami tidak akan pernah meminta kode OTP Anda melalui email atau pesan lain.</small>
      </p>

      <!-- Additional Help -->
      <p style="color: #666; font-size: 14px;">
        Jika Anda tidak melakukan permintaan ini, silakan abaikan email ini.
      </p>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p style="margin: 0;">
        &copy; {{ date('Y') }} Aplikasi BK. Semua hak dilindungi.
      </p>
      <p style="margin: 5px 0 0 0; color: #bbb;">
        Email ini dikirim otomatis, mohon tidak membalas email ini.
      </p>
    </div>
  </div>
</body>

</html>