<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
        .reset-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            max-width: 450px;
            width: 100%;
        }
        .reset-icon {
            font-size: 4rem;
            color: #0099C9;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #0099C9;
            box-shadow: 0 0 0 0.2rem rgba(0, 153, 201, 0.1);
        }
        .form-control.is-invalid {
            border-color: #dc3545;
        }
        .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0099C9, #0077B6);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
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
        .password-requirements {
            background: #f8f9ff;
            border-left: 4px solid #0099C9;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        .password-requirements h6 {
            color: #0099C9;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .password-requirements ul {
            margin: 0;
            padding-left: 1.25rem;
        }
        .password-requirements li {
            margin-bottom: 0.25rem;
            color: #6c757d;
        }
        h2 {
            color: #333;
            margin-bottom: 1rem;
            text-align: center;
        }
        .success-message {
            text-align: center;
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }
        .toggle-password {
            cursor: pointer;
            color: #0099C9;
            position: absolute;
            right: 15px;
            top: 38px;
        }
        .password-field-wrapper {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="reset-card">
        <div class="reset-icon">
            <i class="fas fa-lock"></i>
        </div>
        
        <h2>Reset Password</h2>
        
        <p class="success-message">
            <i class="fas fa-check-circle text-success me-2"></i>
            OTP Anda telah diverifikasi. Silakan buat password baru yang kuat.
        </p>

        <!-- Password Requirements -->
        <div class="password-requirements">
            <h6>Persyaratan Password:</h6>
            <ul>
                <li>Minimal 8 karakter</li>
                <li>Kombinasi huruf, angka, dan simbol</li>
                <li>Jangan gunakan password yang mudah ditebak</li>
            </ul>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Form Reset Password -->
        <form method="POST" action="{{ route('password.update-otp') }}" id="resetForm">
            @csrf

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <div class="password-field-wrapper">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        placeholder="Masukkan password baru"
                        required
                    />
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('password')"></i>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-times-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <div class="password-field-wrapper">
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        placeholder="Ulangi password baru"
                        required
                    />
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('password_confirmation')"></i>
                </div>
                @error('password_confirmation')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-times-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Simpan Password Baru
            </button>
        </form>

        <!-- Back to Login -->
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="btn btn-link">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
            </a>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = event.target;
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Validasi password matching
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            
            if (password !== confirmation) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
            }
        });
    </script>
</body>
</html>
