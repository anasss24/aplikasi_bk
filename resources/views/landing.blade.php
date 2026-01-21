<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi BK - Aplikasi Bimbingan Konseling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background: linear-gradient(135deg, #0077aa 0%, #005588 50%, #003366 100%);
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(0, 119, 170, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(0, 85, 136, 0.15) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        body > * {
            position: relative;
            z-index: 1;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            border-bottom: 2px solid rgba(0, 119, 170, 0.3);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #0d1b2a;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo-icon svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 4px 12px rgba(0, 119, 170, 0.3));
        }

        .logo-text {
            background: linear-gradient(135deg, #0d1b2a 0%, #0088bb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: #0d1b2a !important;
            transition: all 0.3s ease;
            margin: 0 8px;
        }

        .nav-link:hover {
            color: #00d9ff !important;
        }

        .btn-login {
            background: linear-gradient(135deg, #0088bb 0%, #006699 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 119, 170, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 119, 170, 0.5);
            color: white;
        }

        .navbar-nav .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(0, 119, 170, 0.6);
            color: #0d1b2a !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .navbar-nav .btn-secondary:hover {
            background: linear-gradient(135deg, #0088bb 0%, #006699 100%);
            color: white !important;
            border-color: #0088bb;
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 80px 0;
        }

        .hero-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .blob {
            position: absolute;
            opacity: 0.25;
            filter: blur(50px);
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            top: -100px;
            right: -50px;
            animation: float1 8s ease-in-out infinite;
        }

        .blob-2 {
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            bottom: -80px;
            left: -50px;
            animation: float2 10s ease-in-out infinite;
        }

        @keyframes float1 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, 20px); }
        }

        @keyframes float2 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-30px, -20px); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            font-family: 'Poppins', sans-serif;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 0.8s ease;
        }

        .hero-title .gradient-text {
            background: linear-gradient(135deg, #ffffff 0%, #e0f7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 2px 4px rgba(0, 217, 255, 0.3));
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2.5rem;
            line-height: 1.8;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 0.8s ease 0.2s both;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin-bottom: 3rem;
            animation: fadeInUp 0.8s ease 0.4s both;
        }

        .btn-primary-grad {
            background: linear-gradient(135deg, #ffffff 0%, #e0f7ff 100%);
            border: none;
            color: #0099cc;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 12px 35px rgba(0, 217, 255, 0.35);
            text-decoration: none;
            display: inline-block;
            backdrop-filter: blur(10px);
        }

        .btn-primary-grad:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 50px rgba(0, 217, 255, 0.45);
            color: #0099cc;
        }

        .btn-secondary-grad {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: white;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            backdrop-filter: blur(10px);
        }

        .btn-secondary-grad:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: white;
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 217, 255, 0.3);
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            position: relative;
            z-index: 1;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            text-align: center;
            margin-bottom: 3rem;
            font-family: 'Poppins', sans-serif;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 0.8s ease;
        }

        .feature-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(224, 247, 255, 0.9) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            border: 2px solid rgba(0, 119, 170, 0.25);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            height: 100%;
            backdrop-filter: blur(10px);
            animation: fadeInUp 0.8s ease both;
        }

        .feature-card:nth-child(1) { animation-delay: 0s; }
        .feature-card:nth-child(2) { animation-delay: 0.1s; }
        .feature-card:nth-child(3) { animation-delay: 0.2s; }
        .feature-card:nth-child(4) { animation-delay: 0.3s; }

        .feature-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 60px rgba(0, 119, 170, 0.3);
            border-color: rgba(0, 119, 170, 0.5);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0088bb 0%, #006699 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 119, 170, 0.3);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 12px 35px rgba(0, 119, 170, 0.4);
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #006699;
            margin-bottom: 1rem;
        }

        .feature-text {
            color: #333;
            line-height: 1.8;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, rgba(13, 27, 42, 0.95) 0%, rgba(0, 85, 136, 0.85) 100%);
            color: white;
            padding: 80px 0;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border-top: 3px solid rgba(0, 119, 170, 0.6);
            border-bottom: 3px solid rgba(0, 119, 170, 0.6);
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
            animation: fadeInUp 0.8s ease;
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 800;
            color: #00aadd;
            font-family: 'Poppins', sans-serif;
            text-shadow: 0 4px 12px rgba(0, 119, 170, 0.4);
        }

        .stat-label {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 0.5rem;
            font-weight: 500;
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .cta-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            font-family: 'Poppins', sans-serif;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .cta-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        footer {
            background: #0d1b2a;
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary-grad, .btn-secondary-grad {
                width: 100%;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-lg">
            <a class="navbar-brand" href="#home">
                <div class="logo-icon">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <!-- Main person circle -->
                        <circle cx="50" cy="30" r="12" fill="#0088bb"/>
                        <!-- Main person body -->
                        <rect x="44" y="45" width="12" height="20" rx="2" fill="#0088bb"/>
                        <!-- Left arm with hand -->
                        <line x1="44" y1="50" x2="25" y2="45" stroke="#0088bb" stroke-width="3" stroke-linecap="round"/>
                        <circle cx="20" cy="43" r="4" fill="#0088bb"/>
                        <!-- Right arm with hand -->
                        <line x1="56" y1="50" x2="75" y2="45" stroke="#0088bb" stroke-width="3" stroke-linecap="round"/>
                        <circle cx="80" cy="43" r="4" fill="#0088bb"/>
                        <!-- Left leg -->
                        <line x1="48" y1="65" x2="42" y2="82" stroke="#0088bb" stroke-width="3" stroke-linecap="round"/>
                        <!-- Right leg -->
                        <line x1="52" y1="65" x2="58" y2="82" stroke="#0088bb" stroke-width="3" stroke-linecap="round"/>
                        <!-- Left supporting hand from bottom -->
                        <path d="M 20 85 Q 25 75 35 70" stroke="#006699" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <circle cx="18" cy="88" r="3.5" fill="#006699"/>
                        <!-- Right supporting hand from bottom -->
                        <path d="M 80 85 Q 75 75 65 70" stroke="#006699" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <circle cx="82" cy="88" r="3.5" fill="#006699"/>
                        <!-- Heart accent above -->
                        <path d="M 50 18 C 50 18 45 12 40 12 C 36 12 33 15 33 19 C 33 25 50 35 50 35 C 50 35 67 25 67 19 C 67 15 64 12 60 12 C 55 12 50 18 50 18 Z" fill="#00aadd" opacity="0.9"/>
                    </svg>
                </div>
                <span class="logo-text">Aplikasi BK</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                </ul>
                <div class="ms-3">
                    <a href="{{ route('login') }}" class="btn btn-login me-2">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="hero-bg">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
        </div>
        <div class="container-lg">
            <div class="hero-content">
                <h1 class="hero-title">
                    Selamat Datang di <span class="gradient-text">Aplikasi BK</span>
                </h1>
                <p class="hero-subtitle">
                    Aplikasi Bimbingan Konseling Modern yang Membantu Anda Mengelola Sesi Konseling, Jadwal, dan Riwayat dengan Mudah dan Efisien
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('register') }}" class="btn-primary-grad">
                        <i class="fas fa-rocket me-2"></i> Mulai Sekarang
                    </a>
                    <a href="#fitur" class="btn-secondary-grad">
                        <i class="fas fa-arrow-down me-2"></i> Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="fitur">
        <div class="container-lg">
            <h2 class="section-title">Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h5 class="feature-title">Manajemen Jadwal</h5>
                        <p class="feature-text">Kelola jadwal konseling dengan mudah, atur metode online atau offline, dan pilih tempat konseling sesuai kebutuhan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <h5 class="feature-title">Riwayat Lengkap</h5>
                        <p class="feature-text">Catatan lengkap setiap sesi konseling termasuk topik, isi, dan tindak lanjut dalam satu tempat yang terorganisir.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="feature-title">Kelola Siswa</h5>
                        <p class="feature-text">Kelola data siswa dengan database terpusat, akses cepat, dan kemudahan pencarian untuk efisiensi maksimal.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="feature-title">Laporan & Analisis</h5>
                        <p class="feature-text">Buat laporan konseling yang komprehensif dan analisis data untuk evaluasi program bimbingan konseling.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section" id="tentang">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <p class="stat-label">Keamanan Data Terjamin</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <p class="stat-label">Akses Kapan Saja</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">∞</div>
                        <p class="stat-label">Skalabilitas Unlimited</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container-lg">
            <h2 class="cta-title">Siap untuk Memulai?</h2>
            <p class="cta-subtitle">Bergabunglah dengan ribuan institusi yang telah mempercayai Aplikasi BK untuk mengelola bimbingan konseling mereka</p>
            <a href="{{ route('register') }}" class="btn-primary-grad">
                <i class="fas fa-user-plus me-2"></i> Daftar Akun Gratis
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container-lg">
            <p>&copy; 2026 Aplikasi BK. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
