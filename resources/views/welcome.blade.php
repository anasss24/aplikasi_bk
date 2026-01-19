<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi BK - Platform Bimbingan Konseling Modern</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Animated Background Elements */
        .animated-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            top: -150px;
            right: -100px;
            animation: float-1 8s ease-in-out infinite;
        }

        .blob-2 {
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.06);
            bottom: -100px;
            left: -50px;
            animation: float-2 10s ease-in-out infinite;
        }

        .blob-3 {
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.05);
            top: 50%;
            right: 10%;
            animation: float-3 12s ease-in-out infinite;
        }

        @keyframes float-1 {
            0%, 100% { transform: translate(0, 0); }
            33% { transform: translate(30px, -30px); }
            66% { transform: translate(-20px, 20px); }
        }

        @keyframes float-2 {
            0%, 100% { transform: translate(0, 0); }
            33% { transform: translate(-25px, 25px); }
            66% { transform: translate(15px, -15px); }
        }

        @keyframes float-3 {
            0%, 100% { transform: translate(0, 0); }
            33% { transform: translate(20px, 20px); }
            66% { transform: translate(-30px, -20px); }
        }

        /* Main Container */
        .welcome-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        .welcome-main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Left Section - Hero */
        .welcome-hero {
            background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            color: white;
            position: relative;
            overflow: hidden;
            gap: 35px;
        }

        .welcome-hero::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .welcome-hero::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .logo-wrapper {
            width: 160px;
            height: 160px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 30px;
            display: none;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            padding: 10px;
            overflow: hidden;
        }

        .logo-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: brightness(1.05) drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .school-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 10px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin: 0 auto 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: fit-content;
        }

        .school-badge i {
            font-size: 1rem;
        }

        .school-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0 0 12px 0;
            line-height: 1.3;
            letter-spacing: -0.5px;
        }

        .school-tagline {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
            font-weight: 400;
            line-height: 1.6;
        }

        .features-showcase {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateX(8px);
        }

        .feature-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .feature-text h4 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .feature-text p {
            font-size: 0.85rem;
            opacity: 0.85;
            margin: 0;
        }

        /* Right Section - Auth */
        .welcome-auth {
            padding: 70px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 50%, #ffffff 100%);
            position: relative;
        }

        .auth-content {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        .auth-header {
            margin-bottom: 40px;
        }

        .auth-subtitle {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
            display: block;
        }

        .auth-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1.2;
            letter-spacing: -0.5px;
            margin-bottom: 15px;
        }

        .auth-description {
            color: #6c757d;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 35px;
        }

        .auth-buttons {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 30px;
            width: 100%;
        }

        .auth-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 24px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            width: 100%;
        }

        .auth-btn-primary {
            background: linear-gradient(135deg, #0099C9 0%, #0077B6 100%);
            color: white !important;
            box-shadow: 0 10px 30px rgba(0, 153, 201, 0.35);
        }

        .auth-btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 40px rgba(0, 153, 201, 0.45);
            color: white !important;
            text-decoration: none;
        }

        .auth-btn-secondary {
            background: white;
            color: #0099C9 !important;
            border: 2.5px solid #0099C9;
            box-shadow: 0 4px 15px rgba(0, 153, 201, 0.1);
        }

        .auth-btn-secondary:hover {
            background: #D4F1FC;
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 153, 201, 0.2);
            color: #0099C9 !important;
            text-decoration: none;
        }

        .auth-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 30px 0;
            color: #bbb;
        }

        .auth-divider-line {
            flex: 1;
            height: 2px;
            background: #ddd;
        }

        .auth-divider-text {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .auth-footer {
            background: linear-gradient(135deg, rgba(0,153,201,0.08) 0%, rgba(0,119,182,0.08) 100%);
            padding: 18px;
            border-radius: 14px;
            text-align: center;
            border: 1px solid rgba(0, 153, 201, 0.15);
        }

        .auth-footer p {
            margin: 0;
            font-size: 0.9rem;
            color: #6c757d;
            line-height: 1.6;
        }

        .auth-footer strong {
            color: #0099C9;
            font-weight: 700;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .welcome-hero {
                padding: 50px 40px;
            }

            .welcome-auth {
                padding: 50px 40px;
            }

            .school-name {
                font-size: 2rem;
            }

            .auth-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .welcome-wrapper {
                padding: 15px;
            }

            .welcome-main {
                grid-template-columns: 1fr;
                border-radius: 20px;
            }

            .welcome-hero {
                padding: 40px 30px;
            }

            .welcome-auth {
                padding: 40px 30px;
            }

            .logo-wrapper {
                width: 130px;
                height: 130px;
                margin-bottom: 20px;
            }

            .school-name {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }

            .school-tagline {
                font-size: 1rem;
                margin-bottom: 25px;
            }

            .auth-title {
                font-size: 1.8rem;
            }

            .auth-description {
                font-size: 0.95rem;
                margin-bottom: 25px;
            }

            .features-showcase {
                gap: 15px;
            }

            .feature-item {
                padding: 12px;
            }

            .auth-btn {
                padding: 14px 20px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 576px) {
            .welcome-wrapper {
                padding: 10px;
            }

            .welcome-hero {
                padding: 30px 20px;
            }

            .welcome-auth {
                padding: 30px 20px;
            }

            .logo-wrapper {
                width: 110px;
                height: 110px;
                margin-bottom: 15px;
            }

            .school-badge {
                font-size: 0.75rem;
                padding: 8px 12px;
            }

            .school-name {
                font-size: 1.5rem;
            }

            .school-tagline {
                font-size: 0.95rem;
                margin-bottom: 20px;
            }

            .auth-title {
                font-size: 1.5rem;
            }

            .auth-subtitle {
                font-size: 0.75rem;
                letter-spacing: 1.2px;
            }

            .auth-description {
                font-size: 0.9rem;
            }

            .feature-item {
                padding: 10px;
                gap: 10px;
                border-radius: 12px;
            }

            .feature-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .feature-text h4 {
                font-size: 0.9rem;
            }

            .feature-text p {
                font-size: 0.8rem;
            }

            .auth-btn {
                padding: 12px 18px;
                font-size: 0.9rem;
                gap: 8px;
            }

            .auth-btn i {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="floating-blob blob-1"></div>
        <div class="floating-blob blob-2"></div>
        <div class="floating-blob blob-3"></div>
    </div>

    <!-- Main Content -->
    <div class="welcome-wrapper">
        <div class="welcome-main">
            <!-- Left Hero Section -->
            <div class="welcome-hero">
                <div class="hero-content">
                    <div class="logo-wrapper">
                        <img src="{{ asset('images/logo-sekolah.jpg') }}" alt="Logo SMK Antartika 1">
                    </div>

                    <div class="school-badge">
                        <i class="fas fa-building"></i>
                        <span>SMK Antartika 1</span>
                    </div>
                    
                    <h1 class="school-name">Transformasi Digital Bimbingan Konseling</h1>
                    <p class="school-tagline">Hadirkan solusi bimbingan konseling yang modern, terintegrasi, dan mudah diakses oleh seluruh komunitas sekolah.</p>
                </div>

                <div class="features-showcase">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Analytics Mendalam</h4>
                            <p>Pantau perkembangan siswa secara real-time</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-message"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Konseling Online</h4>
                            <p>Layanan chat & jadwal konseling interaktif</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Keamanan Terjamin</h4>
                            <p>Data terenkripsi dan privasi terlindungi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Auth Section -->
            <div class="welcome-auth">
                <div class="auth-content">
                    <div class="auth-header">
                        <span class="auth-subtitle">✨ Selamat Datang</span>
                        <h2 class="auth-title">Aplikasi BK</h2>
                        <p class="auth-description">Platform manajemen bimbingan dan konseling terpadu untuk SMK Antartika 1 Sidoarjo. Optimalkan layanan konseling Anda hari ini.</p>
                    </div>

                    <div class="auth-buttons">
                        <a href="{{ route('login') }}" class="auth-btn auth-btn-primary">
                            <i class="fas fa-arrow-right"></i> Masuk ke Platform
                        </a>
                        <a href="{{ route('register') }}" class="auth-btn auth-btn-secondary">
                            <i class="fas fa-user-plus"></i> Buat Akun Baru
                        </a>
                    </div>

                    <div class="auth-divider">
                        <div class="auth-divider-line"></div>
                        <span class="auth-divider-text">atau</span>
                        <div class="auth-divider-line"></div>
                    </div>

                    <div class="auth-footer">
                        <p><strong>Sudah punya akun?</strong></p>
                        <p>Klik "Masuk ke Platform" untuk lanjut</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
