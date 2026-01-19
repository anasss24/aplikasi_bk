<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .otp-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            max-width: 450px;
            width: 100%;
        }
        .otp-icon {
            font-size: 4rem;
            color: #0099C9;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .otp-input {
            font-size: 1.5rem;
            text-align: center;
            letter-spacing: 0.5rem;
            font-weight: bold;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }
        .otp-input:focus {
            border-color: #0099C9;
            box-shadow: 0 0 0 0.2rem rgba(0, 153, 201, 0.1);
            outline: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0099C9, #0077B6);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            width: 100%;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0077B6, #005a95);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 153, 201, 0.3);
        }
        .btn-link {
            color: #0099C9;
            text-decoration: none;
            font-weight: 500;
        }
        .btn-link:hover {
            color: #0077B6;
            text-decoration: underline;
        }
        .timer {
            color: #dc3545;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .instruction-text {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }
        .email-display {
            background: #f8f9ff;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #0099C9;
            word-break: break-all;
        }
        .resend-container {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }
        .resend-text {
            color: #6c757d;
            font-size: 0.9rem;
        }
        h2 {
            color: #333;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="otp-card">
        <div class="otp-icon">
            <i class="fas fa-key"></i>
        </div>
        
        <h2>Verifikasi OTP</h2>
        
        <p class="instruction-text">
            Kami telah mengirimkan kode OTP 6 digit ke email Anda.
        </p>

        <div class="email-display">
            <i class="fas fa-envelope me-2"></i>{{ $email }}
        </div>

        <!-- Status Messages -->
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Form Verifikasi OTP -->
        <form method="POST" action="{{ route('password.verify-otp-check') }}">
            @csrf

            <div class="mb-3">
                <label for="otp_code" class="form-label">Kode OTP</label>
                <input 
                    type="text" 
                    id="otp_code" 
                    name="otp_code" 
                    class="form-control otp-input @error('otp_code') is-invalid @enderror" 
                    placeholder="000000"
                    maxlength="6"
                    pattern="[0-9]{6}"
                    required
                    autofocus
                />
                @error('otp_code')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-times-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mb-3">
                <i class="fas fa-check me-2"></i>Verifikasi OTP
            </button>
        </form>

        <!-- Resend OTP -->
        <div class="resend-container">
            <p class="resend-text mb-2">Belum menerima kode OTP?</p>
            <form method="POST" action="{{ route('password.resend-otp') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link">
                    <i class="fas fa-redo me-1"></i>Kirim Ulang OTP
                </button>
            </form>
        </div>

        <!-- Back to Login -->
        <div class="text-center mt-3">
            <a href="{{ route('password.request') }}" class="btn btn-link">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Lupa Password
            </a>
        </div>
    </div>

    <script>
        // Format input OTP hanya angka
        document.getElementById('otp_code').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 6);
        });
    </script>
</body>
</html>
