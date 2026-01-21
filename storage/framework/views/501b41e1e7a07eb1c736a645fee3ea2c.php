<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Aplikasi BK'); ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, #0d1b2a 0%, #132f4c 50%, #0f1419 100%);
            padding: 30px 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 8px 0 35px rgba(0, 0, 0, 0.5);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar-brand {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #00d9ff 0%, #0099cc 50%, #00a8e8 100%);
            margin: 20px 15px 25px 15px;
            padding: 14px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 217, 255, 0.4);
            border: 1px solid rgba(0, 217, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .sidebar-brand::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.2; }
        }

        .sidebar-brand h5 {
            margin: 0;
            font-weight: 800;
            font-size: 1.08rem;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }

        .sidebar-brand i {
            font-size: 1.3rem;
            color: #fff;
            position: relative;
            z-index: 1;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 30px;
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 12px;
            font-weight: 500;
            position: relative;
            border-radius: 8px;
            margin: 0 15px 4px 15px;
            font-size: 0.95rem;
        }

        .sidebar-menu a:hover {
            background: rgba(0, 217, 255, 0.12);
            color: #00d9ff;
            padding-left: 40px;
        }

        .sidebar-menu a.active {
            background: linear-gradient(90deg, rgba(0, 217, 255, 0.2) 0%, rgba(0, 168, 232, 0.1) 100%);
            color: #00ffff;
            box-shadow: inset 0 0 15px rgba(0, 217, 255, 0.2);
            
        }

        .sidebar-menu i {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
        }

        .sidebar-menu .menu-label {
            padding: 15px 30px 10px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 700;
            margin-top: 15px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }

        /* Top Navbar */
        .topbar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .notification-badge {
            display: none;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-menu:hover {
            opacity: 0.9;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .user-info {
            text-align: right;
        }

        .user-info p {
            margin: 0;
            font-size: 0.9rem;
        }

        .user-info .name {
            font-weight: 700;
            color: #1e293b;
        }

        .user-info .role {
            font-size: 0.8rem;
            color: #64748b;
            text-transform: capitalize;
        }

        .page-header {
            margin-bottom: 35px;`n            padding-bottom: 20px;
        }

        .page-header h3 {
            font-weight: 700;
            color: #1e293b;
        }

        /* Container Fluid Adjustments */
        .container-fluid {
            padding-left: 30px;
            padding-right: 30px;
        }

        .content {
            padding: 30px;
        }

        .breadcrumb-wrapper {
            margin-bottom: 30px;
        }

        .page-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #1e293b 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            margin-bottom: 20px;
            background: white;
        }

        .card:hover {
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

        .card-header {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            color: white;
            border: none;
            border-radius: 12px 12px 0 0;
            padding: 20px;
            font-weight: 700;
            border-bottom: 0;
        }

        .card-body {
            padding: 25px;
        }

        /* Stats Card */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(59, 130, 246, 0.1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.3; }
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
            border-color: #3b82f6;
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.8rem;
            position: relative;
            z-index: 1;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.05) 100%);
            color: #3b82f6;
        }

        .stat-icon.green {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0.05) 100%);
            color: #10b981;
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(249, 115, 22, 0.05) 100%);
            color: #f97316;
        }

        .stat-icon.red {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.05) 100%);
            color: #ef4444;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 800;
            color: #1e293b;
            margin: 10px 0;
            position: relative;
            z-index: 1;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            margin: 0;
            position: relative;
            z-index: 1;
            font-weight: 500;
        }

        /* Buttons */
        .btn {
            padding: 8px 16px !important;
            font-size: 0.9rem !important;
            font-weight: 700 !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
            border: none !important;
            text-align: center !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00d9ff 0%, #0099cc 50%, #00a8e8 100%) !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(0, 217, 255, 0.3) !important;
            margin-bottom: 8px !important;
        }

        .btn-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(0, 217, 255, 0.4) !important;
            background: linear-gradient(135deg, #00c9f0 0%, #0088bb 50%, #0099dd 100%) !important;
        }

        .btn-primary:active {
            transform: translateY(0) !important;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 50%, #b91c1c 100%) !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3) !important;
        }

        .btn-secondary:hover {
            transform: translateY(-2px) !important;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #991b1b 100%) !important;
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4) !important;
        }

        .btn-secondary:active {
            transform: translateY(0) !important;
        }

        .btn-info {
            background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #00d9ff 100%) !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(0, 217, 255, 0.3) !important;
        }

        .btn-info:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(0, 217, 255, 0.4) !important;
            background: linear-gradient(135deg, #0891b2 0%, #00d9ff 50%, #00c9f0 100%) !important;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%) !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
        }

        .btn-success:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4) !important;
            background: linear-gradient(135deg, #059669 0%, #047857 50%, #065f46 100%) !important;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 50%, #ea580c 100%) !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3) !important;
        }

        .btn-warning:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4) !important;
            background: linear-gradient(135deg, #f97316 0%, #ea580c 50%, #dc2626 100%) !important;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 50%, #b91c1c 100%) !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3) !important;
        }

        .btn-danger:hover {
            transform: translateY(-2px) !important;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #991b1b 100%) !important;
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4) !important;
        }

        /* Alert */
        .alert-custom {
            border: none;
            border-radius: 12px;
            border-left: 5px solid;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .alert-custom.success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
            border-left-color: #10b981;
            color: #047857;
        }

        .alert-custom.info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
            border-left-color: #3b82f6;
            color: #1e40af;
        }

        .alert-custom.warning {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.1) 0%, rgba(249, 115, 22, 0.05) 100%);
            border-left-color: #f97316;
            color: #b45309;
        }

        .alert-custom.danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
            border-left-color: #ef4444;
            color: #b91c1c;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 260px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .page-title {
                font-size: 1.4rem;
            }

            .content {
                padding: 20px;
            }
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
            border: 1px solid #e2e8f0;
        }

        .dropdown-item {
            padding: 12px 20px;
            transition: all 0.3s ease;
            color: #1e293b;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
            color: #3b82f6;
        }

        .dropdown-divider {
            margin: 8px 0;
            border-color: #e2e8f0;
        }

        /* Utility */
        .text-muted {
            color: #64748b !important;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .content > .card {
            animation: slideDown 0.4s ease;
        }

        .stat-card {
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Table styling */
        .table {
            border-collapse: collapse;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: #1e293b;
            font-weight: 700;
            border-bottom: 2px solid rgba(59, 130, 246, 0.1);
            padding: 15px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(59, 130, 246, 0.05);
        }

        .table tbody td {
            padding: 15px;
            color: #475569;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Form Styling */
        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 11px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .form-label {
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 8px;
        }

        /* Loading Animation */
        .spinner {
            border: 3px solid rgba(59, 130, 246, 0.1);
            border-top-color: #3b82f6;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="<?php echo e(route('home')); ?>" class="sidebar-brand">
            <i class="fas fa-graduation-cap"></i>
            <h5>Aplikasi BK</h5>
        </a>

        <ul class="sidebar-menu">
            <li class="menu-label">Menu Utama</li>
            <li>
                <a href="<?php echo e(route('home')); ?>" class="<?php if(request()->routeIs('home', 'dashboard')): ?> active <?php endif; ?>">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if(auth()->guard()->check()): ?>
                <?php if((Auth::user()->role ?? null) === 'siswa'): ?>
                    <li class="menu-label">Konseling</li>
                    <li>
                        <a href="<?php echo e(route('jadwal.index')); ?>" class="<?php if(request()->routeIs('jadwal.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Jadwal Konseling</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('riwayat.index')); ?>" class="<?php if(request()->routeIs('riwayat.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-history"></i>
                            <span>Riwayat Konseling</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('assessment.index')); ?>" class="<?php if(request()->routeIs('assessment.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Self Assessment</span>
                        </a>
                    </li>

                    <li class="menu-label">Pembelajaran</li>
                    <li>
                        <a href="<?php echo e(route('materi.index')); ?>" class="<?php if(request()->routeIs('materi.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-book"></i>
                            <span>Materi BK</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('kuisioner.index')); ?>" class="<?php if(request()->routeIs('kuisioner.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-poll"></i>
                            <span>Kuisioner</span>
                        </a>
                    </li>

                    <li class="menu-label">Lainnya</li>
                    <li>
                        <a href="<?php echo e(route('chat.index')); ?>" class="<?php if(request()->routeIs('chat.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-comments"></i>
                            <span>Chat</span>
                        </a>
                    </li>
                <?php elseif((Auth::user()->role ?? null) === 'guru_bk'): ?>
                    <li class="menu-label">Manajemen</li>
                    <li>
                        <a href="<?php echo e(route('siswa.index')); ?>" class="<?php if(request()->routeIs('siswa.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-users"></i>
                            <span>Data Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('jadwal.index')); ?>" class="<?php if(request()->routeIs('jadwal.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-calendar-check"></i>
                            <span>Jadwal Konseling</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('riwayat.index')); ?>" class="<?php if(request()->routeIs('riwayat.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-file-alt"></i>
                            <span>Riwayat Konseling</span>
                        </a>
                    </li>

                    <li class="menu-label">Konten</li>
                    <li>
                        <a href="<?php echo e(route('materi.index')); ?>" class="<?php if(request()->routeIs('materi.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-file-upload"></i>
                            <span>Upload Materi</span>
                        </a>
                    </li>

                    <li class="menu-label">Lainnya</li>
                    <li>
                        <a href="<?php echo e(route('chat.index')); ?>" class="<?php if(request()->routeIs('chat.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-comments"></i>
                            <span>Chat</span>
                        </a>
                    </li>
                <?php elseif((Auth::user()->role ?? null) === 'admin'): ?>
                    <li class="menu-label">Manajemen</li>
                    <li>
                        <a href="<?php echo e(route('admin.users')); ?>" class="<?php if(request()->routeIs('admin.users')): ?> active <?php endif; ?>">
                            <i class="fas fa-user-shield"></i>
                            <span>Manajemen User</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.kelas.index')); ?>" class="<?php if(request()->routeIs('admin.kelas.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-school"></i>
                            <span>Data Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.jurusan.index')); ?>" class="<?php if(request()->routeIs('admin.jurusan.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-sitemap"></i>
                            <span>Data Jurusan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/siswa" class="<?php if(request()->routeIs('admin.siswa.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-users"></i>
                            <span>Data Siswa</span>
                        </a>
                    </li>

                    <li class="menu-label">Pelaporan</li>
                    <li>
                        <a href="<?php echo e(route('admin.laporan.index')); ?>" class="<?php if(request()->routeIs('admin.laporan.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-file-pdf"></i>
                            <span>Laporan</span>
                        </a>
                    </li>

                    <li class="menu-label">Sistem</li>
                    <li>
                        <a href="<?php echo e(route('admin.profile')); ?>" class="<?php if(request()->routeIs('admin.profile')): ?> active <?php endif; ?>">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('log.index')); ?>" class="<?php if(request()->routeIs('log.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-list"></i>
                            <span>Log Aktivitas</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="menu-label">Akun</li>
                <li>
                    <a href="<?php echo e(route('profile.edit')); ?>" class="<?php if(request()->routeIs('profile.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-user-circle"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" id="logout-form">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a href="#" onclick="document.getElementById('logout-form').submit()">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn btn-light d-md-none" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="topbar-right">
                <div class="dropdown">
                    <a href="#" class="user-menu text-decoration-none text-dark" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            <?php if(auth()->guard()->check()): ?>
                                <?php echo e(strtoupper(substr(Auth::user()->name ?? '', 0, 1))); ?>

                            <?php endif; ?>
                        </div>
                        <div class="user-info">
                            <?php if(auth()->guard()->check()): ?>
                                <p class="name"><?php echo e(Auth::user()->name ?? 'User'); ?></p>
                                <p class="role"><?php echo e(ucfirst(str_replace('_', ' ', Auth::user()->role ?? 'user'))); ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">
                            <i class="fas fa-user-circle me-2"></i>Profile
                        </a></li>
                        <li><a class="dropdown-item" href="#">
                            <i class="fas fa-cog me-2"></i>Pengaturan
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#" onclick="document.getElementById('logout-form').submit()">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content">
            <?php if(session('success')): ?>
                <div class="alert alert-custom success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-custom danger">
                    <i class="fas fa-times-circle me-2"></i>
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- Footer -->
    <footer style="text-align: center; padding: 25px; color: #64748b; font-size: 0.9rem; margin-left: 280px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-top: 1px solid rgba(59, 130, 246, 0.1); font-weight: 500;">
        <p>&copy; 2025 Aplikasi BK SMK ANTARTIKA 1 | Dirancang untuk meningkatkan kualitas layanan bimbingan konseling 🎓</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
        // Real-time Clock
        function updateClock() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const timeString = now.toLocaleDateString('id-ID', options);
            
            const clockElement = document.getElementById('real-time-clock');
            if (clockElement) {
                clockElement.textContent = timeString;
            }
        }

        // Update clock setiap detik
        updateClock();
        setInterval(updateClock, 1000);

        // Sidebar toggle untuk mobile
        document.getElementById('sidebar-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Close sidebar saat klik di luar
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggle = document.getElementById('sidebar-toggle');
            if (sidebar && toggle && !sidebar.contains(event.target) && !toggle.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });

        // Modern Delete Confirmation dengan SweetAlert2
        function confirmDeleteModern(form, message = 'Yakin ingin menghapus data ini?') {
            event.preventDefault();
            Swal.fire({
                title: 'Hapus Data',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
                allowEscapeKey: false,
                backdrop: true,
                didOpen: (modal) => {
                    modal.classList.add('modern-alert');
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }

        // Otomatis convert semua form dengan class 'delete-form' ke SweetAlert
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                const btn = form.querySelector('button[type="submit"]');
                if (btn) {
                    const message = btn.dataset.deleteMessage || 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.';
                    btn.removeAttribute('onclick');
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        confirmDeleteModern(form, message);
                    });
                }
            });
        });
    </script>

    <style>
        /* Modern Alert Styling */
        .modern-alert {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Customize SweetAlert2 */
        .swal2-popup {
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(0, 0, 0, 0.1);
            width: 90% !important;
            max-width: 400px !important;
            padding: 1.5rem !important;
        }

        .swal2-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.8rem;
        }

        .swal2-html-container {
            font-size: 0.95rem;
            color: #666;
            margin: 1rem 0 !important;
            line-height: 1.5;
        }

        .swal2-confirm, .swal2-cancel {
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0.5rem 1.5rem !important;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
            min-width: 100px;
        }

        .swal2-confirm:hover {
            background-color: #c82333 !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .swal2-cancel:hover {
            background-color: #5a6268 !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        .swal2-icon-warning {
            color: #ff9800;
        }

        .swal2-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .swal2-actions {
            margin-top: 1.5rem;
            gap: 10px;
        }
    </style>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\aplikasi_bk\resources\views/layouts/app.blade.php ENDPATH**/ ?>