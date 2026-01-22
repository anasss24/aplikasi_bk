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
                <p class="text-muted">Sudah punya akun? <a href="<?php echo e(route('login')); ?>">Login di sini</a></p>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <strong>Gagal!</strong>
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('register')); ?>" novalidate>
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name')); ?>" placeholder="Masukkan nama lengkap Anda" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Masukkan email Anda" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" placeholder="Minimal 8 karakter" required>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password Anda" required>
                        <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nis" name="nis" value="<?php echo e(old('nis')); ?>" placeholder="Masukkan NIS Anda (10 angka)" inputmode="numeric" pattern="[0-9]*" maxlength="10" required>
                        <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN (Nomor Induk Siswa Nasional)</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nisn" name="nisn" value="<?php echo e(old('nisn')); ?>" placeholder="Masukkan NISN Anda (10 angka)" inputmode="numeric" pattern="[0-9]*" maxlength="10" required>
                        <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="<?php echo e(env('RECAPTCHA_SITE_KEY')); ?>"></div>
                        <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback d-block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/auth/register.blade.php ENDPATH**/ ?>