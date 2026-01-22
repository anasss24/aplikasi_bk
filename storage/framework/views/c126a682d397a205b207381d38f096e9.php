<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Aplikasi BK</title>
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
            text-align: center;
        }
        .otp-icon {
            font-size: 4rem;
            color: #0099C9;
            margin-bottom: 1.5rem;
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
        .instruction-box {
            background: #f8f9ff;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            text-align: left;
            border-left: 4px solid #0099C9;
        }
        .instruction-box h6 {
            color: #0099C9;
            margin-bottom: 0.5rem;
        }
        .otp-code-display {
            background: linear-gradient(135deg, #0099C9, #0077B6);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0099C9, #0077B6);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0077B6, #005a95);
        }
        .alert-info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
        }
    </style>
</head>
<body>
    <div class="otp-card">
        <div class="otp-icon">
            <i class="fas fa-shield-alt"></i>
        </div>
        
        <h2 class="mb-3">Verifikasi OTP</h2>
        
        <p class="text-muted mb-4">
            Masukkan kode OTP 6 digit yang telah dikirim ke email Anda.
        </p>

        <!-- Pesan Info -->
        <?php if(session('info')): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                <?php echo e(session('info')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Pesan Sukses -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Pesan Error -->
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Instruction Box -->
        <div class="instruction-box">
            <h6><i class="fas fa-info-circle me-2"></i>Petunjuk:</h6>
            <ul class="mb-0 small">
                <li>Kode OTP telah dikirim ke email Anda</li>
                <li>Periksa folder <strong>Spam/Promosi</strong> jika tidak ditemukan</li>
                <li>Kode OTP berlaku selama <strong>10 menit</strong></li>
                <li>Jangan bagikan kode ini kepada siapapun</li>
            </ul>
        </div>

        <form method="POST" action="<?php echo e(route('verify.otp')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <input type="text" 
                       name="otp_code" 
                       class="form-control otp-input" 
                       placeholder="000000" 
                       maxlength="6" 
                       required
                       autofocus
                       pattern="[0-9]*"
                       inputmode="numeric">
                <small class="text-muted mt-2 d-block">Masukkan 6 digit kode OTP</small>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                <i class="fas fa-check-circle me-2"></i>Verifikasi OTP
            </button>
        </form>

        <?php if(auth()->guard()->check()): ?>
            <form method="POST" action="<?php echo e(route('resend.otp')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-outline-secondary w-100 mb-3">
                    <i class="fas fa-redo me-2"></i>Kirim Ulang OTP
                </button>
            </form>

            <div class="mt-3">
                <a href="<?php echo e(route('logout')); ?>" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="text-decoration-none text-muted">
                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </div>

            <!-- Info Email -->
            <div class="mt-3 pt-3 border-top">
                <small class="text-muted">
                    <i class="fas fa-envelope me-1"></i>
                    OTP dikirim ke: <?php echo e(Auth::user()->email); ?>

                </small>
            </div>
        <?php else: ?>
            <div class="mt-3 pt-3 border-top">
                <small class="text-muted">
                    <i class="fas fa-envelope me-1"></i>
                    OTP dikirim ke: <?php echo e(session('otp_email') ?? 'Email Anda'); ?>

                </small>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Auto format OTP input - hanya angka
        document.addEventListener('DOMContentLoaded', function() {
            const otpInput = document.querySelector('input[name="otp_code"]');
            
            if (otpInput) {
                otpInput.addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    
                    // Auto submit jika sudah 6 digit
                    if (this.value.length === 6) {
                        this.form.submit();
                    }
                });

                // Focus ke input
                otpInput.focus();
            }
        });
    </script>
</body>
</html><?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/auth/verify-otp.blade.php ENDPATH**/ ?>