@extends("layouts.app")

@section("content")
<style>
    .dashboard-container {
        padding: 30px 0;
    }

    /* Header Section */
    .dashboard-header {
        background: linear-gradient(135deg, #00d9ff 0%, #0099cc 50%, #00a8e8 100%);
        padding: 35px 30px;
        border-radius: 14px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 15px 45px rgba(0, 217, 255, 0.3);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 217, 255, 0.2);
    }

    .dashboard-header::before {
        content: "";
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .dashboard-header::after {
        content: "";
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .dashboard-header::before {
        content: "";
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .dashboard-header::after {
        content: "";
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
    }

    .dashboard-header h2 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 10px;
        font-family: "Poppins", sans-serif;
        position: relative;
        z-index: 1;
    }

    .dashboard-header p {
        font-size: 1.1rem;
        opacity: 0.95;
        margin: 0;
        position: relative;
        z-index: 1;
        font-weight: 500;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 25px;
        margin-bottom: 35px;
    }

    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(59, 130, 246, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: "";
        position: absolute;
        top: -100px;
        right: -100px;
        width: 250px;
        height: 250px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(139, 92, 246, 0.04) 100%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(59, 130, 246, 0.12);
        border-color: #3b82f6;
    }

    .stat-card.blue { border-left: 5px solid #3b82f6; }
    .stat-card.green { border-left: 5px solid #10b981; }
    .stat-card.orange { border-left: 5px solid #f97316; }
    .stat-card.red { border-left: 5px solid #ef4444; }

    .stat-icon {
        font-size: 2.2rem;
        margin-bottom: 12px;
        position: relative;
        z-index: 1;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 5px;
        font-family: "Poppins", sans-serif;
        position: relative;
        z-index: 1;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .stat-trend {
        font-size: 0.8rem;
        color: #10b981;
        font-weight: 600;
        position: relative;
        z-index: 1;
    }

    .stat-trend.down { color: #ef4444; }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-bottom: 35px;
    }

    @media (max-width: 1024px) {
        .content-grid { grid-template-columns: 1fr; }
    }

    /* Activity Card */
    .activity-card {
        background: white;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(59, 130, 246, 0.08);
    }

    .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 15px;
    }

    .activity-header h3 {
        font-size: 1.4rem;
        font-weight: 800;
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        font-family: "Poppins", sans-serif;
    }

    .activity-header a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .activity-header a:hover {
        color: #8b5cf6;
    }

    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        padding: 20px 0;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        gap: 15px;
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        background: #f8fafc;
        margin: 0 -10px;
        padding: 20px 10px;
        border-radius: 8px;
    }

    .activity-item:last-child { border-bottom: none; }

    .activity-indicator {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #3b82f6;
        margin-top: 3px;
        flex-shrink: 0;
        box-shadow: 0 0 0 5px rgba(59, 130, 246, 0.1);
        animation: pulse-dot 2s ease-in-out infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { box-shadow: 0 0 0 5px rgba(59, 130, 246, 0.1); }
        50% { box-shadow: 0 0 0 8px rgba(59, 130, 246, 0.05); }
    }

    .activity-indicator.blue { background: #3b82f6; }
    .activity-indicator.green { background: #10b981; }
    .activity-indicator.orange { background: #f97316; }
    .activity-indicator.red { background: #ef4444; }

    .activity-content h4 {
        margin: 0 0 5px 0;
        color: #1e293b;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .activity-content p {
        margin: 5px 0;
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .activity-time {
        color: #94a3b8;
        font-size: 0.85rem;
        margin-top: 8px;
        font-weight: 500;
    }

    /* Sidebar Cards */
    .sidebar-card {
        background: white;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(59, 130, 246, 0.08);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .sidebar-card:hover {
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.12);
    }

    .sidebar-card h3 {
        font-size: 1.2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 20px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: "Poppins", sans-serif;
    }

    .sidebar-card h3 i { 
        color: #3b82f6;
        -webkit-text-fill-color: unset;
        background: unset;
    }

    .action-button {
        width: 100%;
        padding: 13px;
        margin-bottom: 12px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .action-button.primary {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .action-button.primary:hover {
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        transform: translateY(-3px);
    }

    .action-button.secondary {
        background: #f8fafc;
        color: #3b82f6;
        border: 2px solid #e2e8f0;
    }

    .action-button.secondary:hover {
        background: #f1f5f9;
        border-color: #3b82f6;
    }

    .info-item {
        padding: 15px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-item:last-child { border-bottom: none; }

    .info-label {
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 6px;
        letter-spacing: 0.5px;
    }

    .info-value {
        color: #1e293b;
        font-weight: 700;
        font-size: 1rem;
        word-break: break-all;
    }

    .badge-role {
        display: inline-block;
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .tips-card {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(139, 92, 246, 0.05) 100%);
        padding: 25px;
        border-radius: 14px;
        border-left: 5px solid #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .tips-card h3 {
        font-size: 1.15rem;
        font-weight: 800;
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 15px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: "Poppins", sans-serif;
    }

    .tips-card p {
        margin: 0 0 15px 0;
        color: #475569;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .tips-link {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .tips-link:hover {
        color: #8b5cf6;
    }

    .icon-teal { color: #3b82f6; }
    .icon-blue { color: #60a5fa; }
    .icon-green { color: #10b981; }
    .icon-orange { color: #f97316; }
</style>

<div class="dashboard-container">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <h2><i class="fas fa-chart-line"></i> Dashboard Aplikasi BK</h2>
        <p>Selamat datang kembali, {{ Auth::user()?->name ?? "Pengguna" }}! 👋</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-icon icon-blue"><i class="fas fa-users"></i></div>
            <div class="stat-label">Pengguna Baru</div>
            <div class="stat-number">45</div>
            <div class="stat-trend"><i class="fas fa-arrow-up"></i> +12% bulan ini</div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon icon-green"><i class="fas fa-comments"></i></div>
            <div class="stat-label">Sesi Konseling</div>
            <div class="stat-number">156</div>
            <div class="stat-trend"><i class="fas fa-arrow-up"></i> +8% bulan ini</div>
        </div>

        <div class="stat-card orange">
            <div class="stat-icon icon-orange"><i class="fas fa-star"></i></div>
            <div class="stat-label">Tingkat Kepuasan</div>
            <div class="stat-number">89%</div>
            <div class="stat-trend"><i class="fas fa-arrow-up"></i> +5% bulan ini</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-teal"><i class="fas fa-book"></i></div>
            <div class="stat-label">Materi BK Aktif</div>
            <div class="stat-number">28</div>
            <div class="stat-trend"><i class="fas fa-arrow-up"></i> +3 baru</div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Activity Section -->
        <div class="activity-card">
            <div class="activity-header">
                <h3><i class="fas fa-history icon-teal"></i> Aktivitas Terbaru</h3>
                <a href="#">Lihat Semua</a>
            </div>
            <ul class="activity-list">
                <li class="activity-item">
                    <div class="activity-indicator blue"></div>
                    <div class="activity-content">
                        <h4>Pengguna Baru Terdaftar</h4>
                        <p>Nisda Ramadhani (Siswa) baru saja bergabung dengan Aplikasi BK</p>
                        <div class="activity-time">5 menit lalu</div>
                    </div>
                </li>

                <li class="activity-item">
                    <div class="activity-indicator green"></div>
                    <div class="activity-content">
                        <h4>Sesi Konseling Selesai</h4>
                        <p>Konseling antara Aris Maulana dengan Ibu Sinta telah selesai dilakukan</p>
                        <div class="activity-time">15 menit lalu</div>
                    </div>
                </li>

                <li class="activity-item">
                    <div class="activity-indicator orange"></div>
                    <div class="activity-content">
                        <h4>Materi BK Diupload</h4>
                        <p>Ibu Sinta telah mengupload materi "Manajemen Stres untuk Siswa"</p>
                        <div class="activity-time">1 jam lalu</div>
                    </div>
                </li>

                <li class="activity-item">
                    <div class="activity-indicator red"></div>
                    <div class="activity-content">
                        <h4>Laporan Pelanggaran</h4>
                        <p>Telah diterima laporan pelanggaran dari Ibu Eka untuk Reza Pratama</p>
                        <div class="activity-time">2 jam lalu</div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Sidebar Content -->
        <div>
            <!-- Quick Actions Card -->
            <div class="sidebar-card">
                <h3><i class="fas fa-bolt"></i> Aksi Cepat</h3>
                <button class="action-button primary">
                    <i class="fas fa-user-plus"></i> Tambah User
                </button>
                <button class="action-button secondary">
                    <i class="fas fa-file-alt"></i> Buat Laporan
                </button>
                <button class="action-button secondary">
                    <i class="fas fa-cog"></i> Pengaturan Sistem
                </button>
            </div>

            <!-- User Info Card -->
            <div class="sidebar-card">
                <h3><i class="fas fa-user-circle"></i> Informasi Akun</h3>
                <div class="info-item">
                    <div class="info-label">Nama</div>
                    <div class="info-value">{{ Auth::user()?->name ?? "Pengguna" }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ Auth::user()?->email ?? "email@example.com" }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Role</div>
                    <div class="info-value">
                        <span class="badge-role">
                            <i class="fas fa-crown"></i> {{ ucfirst(Auth::user()?->role ?? "User") }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="tips-card">
                <h3><i class="fas fa-lightbulb"></i> Tips Hari Ini</h3>
                <p>Manfaatkan fitur pencarian untuk menemukan riwayat konseling dengan cepat dan efisien!</p>
                <a href="#" class="tips-link">Pelajari Lebih Lanjut →</a>
            </div>
        </div>
    </div>
</div>
@endsection
