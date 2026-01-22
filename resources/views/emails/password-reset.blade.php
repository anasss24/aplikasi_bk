<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #0099C9; color: white; padding: 20px; border-radius: 5px 5px 0 0; }
        .content { background-color: #f9f9f9; padding: 20px; border-radius: 0 0 5px 5px; }
        .button { display: inline-block; background-color: #0099C9; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px; margin-top: 15px; }
        .footer { margin-top: 20px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reset Kata Sandi</h2>
        </div>
        <div class="content">
            <p>Halo {{ $userName }},</p>
            
            <p>Kami menerima permintaan untuk mereset kata sandi akun Anda di Aplikasi BK.</p>
            
            <p>Klik tombol di bawah ini untuk mereset kata sandi Anda:</p>
            
            <a href="{{ $resetLink }}" class="button">Reset Kata Sandi</a>
            
            <p style="margin-top: 20px;">Atau salin link berikut ke browser Anda:</p>
            <p style="word-break: break-all; color: #0099C9;">{{ $resetLink }}</p>
            
            <p style="margin-top: 20px; color: #666;">Link ini akan berlaku selama 60 menit.</p>
            
            <p>Jika Anda tidak melakukan permintaan ini, silakan abaikan email ini.</p>
            
            <div class="footer">
                <p>Email ini dikirim secara otomatis, mohon jangan balas email ini.</p>
                <p>&copy; {{ date('Y') }} Aplikasi BK. Semua hak dilindungi.</p>
            </div>
        </div>
    </div>
</body>
</html>
