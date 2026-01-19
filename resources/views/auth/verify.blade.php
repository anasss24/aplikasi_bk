<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email - Aplikasi BK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .verification-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        .verification-icon {
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="verification-card">
        <div class="verification-icon">
            <i class="fas fa-envelope-circle-check"></i>
        </div>
        
        <h2 class="mb-3">Verifikasi Email Anda</h2>
        
        <p class="text-muted mb-4">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi email Anda dengan mengklik link yang kami kirim ke email Anda.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                Link verifikasi baru telah dikirim ke email Anda!
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-paper-plane me-2"></i>Kirim Ulang Email Verifikasi
            </button>
        </form>

        <div class="mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>