<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aplikasi BK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .auth-container { width: 100%; max-width: 1000px; }
        .auth-card { background: white; border-radius: 15px; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); overflow: hidden; display: grid; grid-template-columns: 1fr 1fr; min-height: 600px; }
        .auth-left { background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%); color: white; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; padding: 40px; }
        .auth-graphics { text-align: center; z-index: 2; position: relative; }
        .auth-graphics h3 { font-size: 2rem; font-weight: 700; margin-bottom: 15px; font-family: 'Poppins', sans-serif; }
        .auth-graphics p { font-size: 1rem; opacity: 0.9; }
        .auth-right { display: flex; flex-direction: column; justify-content: center; padding: 50px 40px; background: white; overflow-y: auto; max-height: 600px; }
        .auth-right h2 { font-family: 'Poppins', sans-serif; font-size: 1.8rem; font-weight: 700; color: #333; margin-bottom: 10px; }
        .auth-right .text-muted { margin-bottom: 30px; font-size: 0.95rem; color: #6c757d !important; }
        .auth-right .text-muted a { color: #0099C9 !important; font-weight: 600; text-decoration: none; }
        .form-label { font-weight: 600; color: #555; margin-bottom: 8px; font-size: 0.95rem; }
        .form-control { border: 2px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 0.95rem; transition: all 0.3s ease; margin-bottom: 15px; }
        .form-control:focus { border-color: #0099C9; box-shadow: 0 0 0 3px rgba(0, 153, 201, 0.1); color: #333; }
        .btn-register { background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%); border: none; padding: 12px 20px; border-radius: 8px; color: white; font-weight: 600; margin-top: 20px; transition: all 0.3s ease; font-size: 1rem; }
        .btn-register:hover { box-shadow: 0 8px 20px rgba(0, 153, 201, 0.4); transform: translateY(-2px); }
        .alert { border-radius: 8px; margin-bottom: 20px; }
        .invalid-feedback { display: block; color: #dc3545; font-size: 0.85rem; margin-top: 5px; }
        .form-control.is-invalid { border-color: #dc3545; }
        @media (max-width: 768px) {
            .auth-card { grid-template-columns: 1fr; min-height: auto; }
            .auth-left { display: none; }
            .auth-right { max-height: none; }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-left">
                <div class="auth-graphics">
                    <h3><i class="fas fa-user-plus"></i></h3>
                    <h3>Buat Akun Baru</h3>
                    <p>Bergabunglah dengan Aplikasi BK</p>
                </div>
            </div>
            <div class="auth-right">
                <h2>Daftar</h2>
                <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Gagal!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required>
                        @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
                        @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter" required>
                        @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password Anda" required>
                        @error('password_confirmation')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') }}" placeholder="Masukkan NIS Anda (10 angka)" inputmode="numeric" pattern="[0-9]*" maxlength="10" required>
                        @error('nis')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN (Nomor Induk Siswa Nasional)</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN Anda (10 angka)" inputmode="numeric" pattern="[0-9]*" maxlength="10" required>
                        @error('nisn')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                        @error('g-recaptcha-response')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    </div>

                    <button type="submit" class="btn btn-register w-100"><i class="fas fa-user-check"></i> Buat Akun</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Hanya izinkan angka untuk NIS dan NISN
        document.getElementById('nis').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        document.getElementById('nisn').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
