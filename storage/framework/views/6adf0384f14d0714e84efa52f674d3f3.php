<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi BK</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 1000px;
        }

        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 500px;
        }

        .auth-left {
            background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 40px;
        }

        .auth-graphics {
            text-align: center;
            z-index: 2;
            position: relative;
        }

        .graphic-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .graphic-1 {
            width: 200px;
            height: 200px;
            top: -50px;
            right: -50px;
        }

        .graphic-2 {
            width: 150px;
            height: 150px;
            bottom: -30px;
            left: -30px;
        }

        .graphic-3 {
            width: 100px;
            height: 100px;
            top: 50%;
            left: 10%;
        }

        .auth-graphics h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            font-family: 'Poppins', sans-serif;
        }

        .auth-graphics p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .auth-right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px 40px;
            background: white;
        }

        .auth-right h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .auth-right .text-muted {
            margin-bottom: 30px;
            font-size: 0.95rem;
            color: #6c757d !important;
        }

        .auth-right .text-muted a {
            color: #0099C9 !important;
            font-weight: 600;
            text-decoration: none;
        }

        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0099C9;
            box-shadow: 0 0 0 3px rgba(0, 153, 201, 0.1);
            color: #333;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-check-label {
            font-size: 0.95rem;
            color: #555;
            margin-left: 5px;
        }

        .form-check-input {
            border: 2px solid #e0e0e0;
            width: 1.2em;
            height: 1.2em;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #00B4D8;
            border-color: #00B4D8;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00B4D8 0%, #0096C7 100%);
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        @media (max-width: 768px) {
            .auth-card {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .auth-left {
                display: none;
            }

            .auth-right {
                padding: 30px 20px;
            }

            .auth-right h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <!-- Right Side - Login Form -->
            <div class="auth-right">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Login</h2>
                    <p class="text-muted">Belum punya akun? 
                        <a href="<?php echo e(route('register')); ?>" class="text-decoration-none">Sign up</a>
                    </p>
                </div>

                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus placeholder="Email">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" placeholder="Password">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <?php if(Route::has('password.request')): ?>
                        <a class="text-decoration-none" href="<?php echo e(route('password.request')); ?>">
                            Lupa password?
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="mb-4">
                        <div class="g-recaptcha" data-sitekey="<?php echo e(env('RECAPTCHA_SITE_KEY')); ?>"></div>
                        <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Login
                        </button>
                    </div>
                </form>
            </div>

            <!-- Left Side - Graphics -->
            <div class="auth-left">
                <div class="auth-graphics">
                    <div class="graphic-circle graphic-1"></div>
                    <div class="graphic-circle graphic-2"></div>
                    <div class="graphic-circle graphic-3"></div>
                    <h3>Selamat Datang!</h3>
                    <p>Masuk ke aplikasi BK kami</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
<?php /**PATH C:\Users\PC_07\aplikasi_bk\resources\views/auth/login.blade.php ENDPATH**/ ?>